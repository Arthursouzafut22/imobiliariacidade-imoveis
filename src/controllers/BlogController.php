<?php

namespace src\controllers;

use src\handlers\Helper;
use src\handlers\Video;
use src\handlers\UrlEncode;
use src\models\CmsConfiguracao;
use src\models\CmsPagina;
use src\models\CmsPaginaCategoria;
use src\models\CmsPaginaConteudo;
use src\models\CmsPaginaConteudoAnexo;
use src\models\CmsPaginaConteudoImagem;
use src\models\CmsPaginaConteudoPerguntaResposta;
use src\models\CmsScriptsExternos;
use \core\Controller;

class BlogController extends Controller
{

    public function __construct()
    {
        $conf = CmsConfiguracao::first()->toArray();
        Helper::siteEmManutencao($conf);
    }

    public function index()
    {
        $dados = [];
        $params = $this->getRequestData();
        $_SESSION[SESSION_UNIC] = [];

        $dados['script'] = CmsScriptsExternos::first()->toArray();

        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();

        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 45)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();

        //$dados['cms_pagina'] = CmsPaginaConteudoImagem::select("*")
        //->join('cms_pagina_conteudo', 'cms_pagina_conteudo_imagem.cod_pagina_conteudo', 'cms_pagina_conteudo.cod_pagina_conteudo')
        //->where('cms_pagina_conteudo_imagem.cod_pagina_conteudo', 50)
        //->get()
        //->toArray();

        $dados['cms_pagina'] = CmsPagina::select("*")
            ->where('cod_pagina', 31)
            ->first()
            ->toArray();

        $dados['cms_pagina_categoria'] = CmsPaginaCategoria::select('*')
            ->where('cod_pagina_tipo', '=', '2')
            ->has('paginas')  // Garante que apenas categorias com páginas associadas sejam incluídas
            ->withCount('paginas')  // Conta o número de páginas para cada categoria
            ->get()
            ->toArray();

        //se não passar o parametro 'pagina'
        $params['pagina'] = (!isset($params['pagina']) ? 1 : $params['pagina']);

        //se não passar o parametro 'busca'
        $params['buscar'] = (!isset($params['buscar']) ? '' : $params['buscar']);
        $dados['buscar'] = (!isset($params['buscar']) ? '' : $params['buscar']);

        //se não passar o parametro 'categoria'
        $params['categoria'] = (!isset($params['categoria']) ? '' : $params['categoria']);
        $dados['categoria_selecionada'] = (!isset($params['categoria']) ? '' : $params['categoria']);

        //config paginação
        $registrosPorPagina = 6;
        $offset = ($params['pagina'] - 1) * $registrosPorPagina;

        //RESULTADO DA BUSCA
        $dados['posts'] = CmsPagina::select([
            "*",
            'cms_pagina.campo_custom1 as data_post',
            'cms_pagina_conteudo_imagem.*'
        ])
            ->leftjoin('cms_pagina_conteudo', 'cms_pagina.cod_pagina', '=', 'cms_pagina_conteudo.cod_pagina')
            ->leftjoin('cms_pagina_conteudo_imagem', 'cms_pagina_conteudo.cod_pagina_conteudo', '=', 'cms_pagina_conteudo_imagem.cod_pagina_conteudo')
            ->leftjoin('cms_pagina_conteudo_anexo', 'cms_pagina_conteudo.cod_pagina_conteudo', '=', 'cms_pagina_conteudo_anexo.cod_pagina_conteudo')
            ->where('cms_pagina.cod_pagina_tipo', '=', 2)
            ->when($params['categoria'] != '', function ($query) use ($params) {
                $query->where('cms_pagina.cod_pagina_categoria', '=', $params['categoria']);
            })
            ->where('cms_pagina.nome_pagina', 'LIKE', '%' . $params['buscar'] . '%')
            ->groupBy('cms_pagina.cod_pagina')
            ->selectRaw('COUNT(*) OVER () as total_registros')
            ->orderByRaw("CASE WHEN `data_publicacao_pagina` = '0000-00-00 00:00:00' THEN 0 ELSE 1 END")
            ->orderBy('data_publicacao_pagina', 'desc')
            ->skip($offset)
            ->take($registrosPorPagina)
            ->get()
            ->map(function ($post) {
                // Mapeia os conteúdos relacionados
                $post->conteudos_relacionados = $post->conteudos->map(function ($conteudo) {
                    return [
                        'imagens' => $conteudo->imagens
                            ->pluck('caminho_imagem_conteudo')
                            ->unique() // Remove duplicatas
                            ->toArray(),
                    ];
                })->toArray();
        
                unset($post->conteudos); // Remove a coleção original, se não for necessária
            
                return $post;
            })
            ->toArray();

        $helper = new Helper();
        $urlEncode = new UrlEncode();

        foreach ($dados['posts'] as $key => $item) {
            
            $dados['posts'][$key]['data_extenso_blog'] = $helper->formatarData($item['data_publicacao_pagina']);
            $dados['posts'][$key]['url_amigavel'] = $urlEncode->amigavelURL($item['titulo_pagina']);
            $dados['posts'][$key]['imagem_card'] = Helper::getFirstImageListBlog($item);
        }

        //Pegar o total de registros
        $totalDeRegistros = (isset($dados['posts'][0]['total_registros']) ? $dados['posts'][0]['total_registros'] : 0);

        //Pegar a quantidade de páginas
        $dados['paginacao'] = ceil((int) $totalDeRegistros / $registrosPorPagina);

        //Passar para o front a página atual
        $dados['pagina'] = $params['pagina'];

        //SESSÃO DA LATERAL DIREITA DA TELA, POSTS RECENTES 
        $dados['posts_recentes'] = CmsPagina::select("*")
            ->join('cms_pagina_conteudo', 'cms_pagina.cod_pagina', '=', 'cms_pagina_conteudo.cod_pagina')
            ->join('cms_pagina_conteudo_imagem', 'cms_pagina_conteudo.cod_pagina_conteudo', '=', 'cms_pagina_conteudo_imagem.cod_pagina_conteudo')
            ->where('cms_pagina.cod_pagina_tipo', '=', 2)
            ->where('cms_pagina.campo_custom2', '=', 0)
            ->selectRaw('COUNT(*) OVER () as total_registros')
            ->orderBy('data_cadastro_pagina', 'asc')
            ->limit(3)
            ->get()
            ->toArray();

        //Adicionano data para o post recentes
        foreach ($dados['posts_recentes'] as $key => $item) {
            $dados['posts_recentes'][$key]['data_extenso_blog'] = $helper->retornarDataPorExtensoBlog($item['data_cadastro_pagina']);
            $dados['posts_recentes'][$key]['url_amigavel'] = $urlEncode->amigavelURL($item['titulo_pagina']);
        }

        //SESSÃO DA LATERAL DIREITA DA TELA, POSTS RECENTES 
        $dados['posts_destaques'] = CmsPagina::select("*")
            ->join('cms_pagina_conteudo', 'cms_pagina.cod_pagina', '=', 'cms_pagina_conteudo.cod_pagina')
            ->join('cms_pagina_conteudo_imagem', 'cms_pagina_conteudo.cod_pagina_conteudo', '=', 'cms_pagina_conteudo_imagem.cod_pagina_conteudo')
            ->where('cms_pagina.cod_pagina_tipo', '=', 2)
            ->where('cms_pagina.campo_custom2', '=', 1)
            ->selectRaw('COUNT(*) OVER () as total_registros')
            ->orderBy('data_cadastro_pagina', 'asc')
            ->limit(3)
            ->get()
            ->toArray();

        //Adicionano data para o post recentes
        foreach ($dados['posts_destaques'] as $key => $item) {
            $dados['posts_destaques'][$key]['data_extenso_blog'] = $helper->retornarDataPorExtensoBlog($item['data_cadastro_pagina']);
            $dados['posts_destaques'][$key]['url_amigavel'] = $urlEncode->amigavelURL($item['titulo_pagina']);
        }


        $dados['cms_pagina']['favicon'] = $dados['configuracoes']['favicon'];

        $this->render('blog', $dados);
    }

    public function detalhe($params)
    {
        $dados = [];

        $dados['script'] = CmsScriptsExternos::first()->toArray();
        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();
        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 45)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();

        $dados['cms_pagina'] = CmsPaginaConteudoImagem::select("*")
            ->join('cms_pagina_conteudo', 'cms_pagina_conteudo_imagem.cod_pagina_conteudo', 'cms_pagina_conteudo.cod_pagina_conteudo')
            ->where('cms_pagina_conteudo_imagem.cod_pagina_conteudo', 50)
            ->get()
            ->toArray();


        $dados['cms_pagina_categoria'] = CmsPaginaCategoria::select('*')
            ->where('cod_pagina_tipo', '=', '2')
            ->has('paginas')  // Garante que apenas categorias com páginas associadas sejam incluídas
            ->withCount('paginas')  // Conta o número de páginas para cada categoria
            ->get()
            ->toArray();

        $params['categoria'] = (!isset($params['categoria']) ? '' : $params['categoria']);
        $dados['categoria_selecionada'] = (!isset($params['categoria']) ? '' : $params['categoria']);



        $dados['conteudos'] = CmsPagina::select("*")
            ->leftjoin('cms_pagina_conteudo', 'cms_pagina.cod_pagina', '=', 'cms_pagina_conteudo.cod_pagina')
            ->leftjoin('cms_pagina_conteudo_imagem', 'cms_pagina_conteudo.cod_pagina_conteudo', '=', 'cms_pagina_conteudo_imagem.cod_pagina_conteudo')
            ->where('cms_pagina_conteudo.cod_pagina', '=', $params['codigopagina'])
            ->get()
            ->toArray();

        $dados['anexos'] = CmsPaginaConteudoAnexo::select(columns: "*")
            ->leftjoin('cms_pagina_conteudo', 'cms_pagina_conteudo_anexo.cod_pagina_conteudo', '=', 'cms_pagina_conteudo.cod_pagina_conteudo')
            ->leftjoin('cms_pagina', 'cms_pagina_conteudo.cod_pagina_conteudo', '=', 'cms_pagina.cod_pagina')
            ->where('cms_pagina_conteudo.cod_pagina', '=', $params['codigopagina'])
            ->get()
            ->toArray();

        $dados['perguntas_respostas'] = CmsPaginaConteudoPerguntaResposta::select(columns: "*")
            ->leftjoin('cms_pagina_conteudo', 'cms_pagina_conteudo_pergunta_resposta.cod_pagina_conteudo', '=', 'cms_pagina_conteudo.cod_pagina_conteudo')
            ->leftjoin('cms_pagina', 'cms_pagina_conteudo.cod_pagina_conteudo', '=', 'cms_pagina.cod_pagina')
            ->where('cms_pagina_conteudo.cod_pagina', '=', $params['codigopagina'])
            ->get()
            ->toArray();



        $dados['conteudo_pagina'] = CmsPagina::select("*")
            ->where('cod_pagina', '=', $params['codigopagina'])
            ->first()
            ->toArray();

        $dados['cms_pagina']['titulo_pagina'] = $dados['conteudo_pagina']['titulo_pagina'];
        $dados['cms_pagina']['meta_titulo_pagina'] = $dados['conteudo_pagina']['meta_titulo_pagina'];
        $dados['cms_pagina']['meta_descricao_pagina'] = $dados['conteudo_pagina']['meta_descricao_pagina'];
        $dados['cms_pagina']['imagem_og'] = "";

        $helper = new Helper();
        $video = new Video();

        foreach ($dados['conteudos'] as $key => $conteudo) {
            $dados['conteudos'][$key]['data_extenso_blog'] = $helper->converterDataParaArray($dados['conteudos'][$key]['data_cadastro_pagina']);
            $dados['conteudos'][$key]['url_video_conteudo'] = $video->tratarVideo($dados['conteudos'][$key]['url_video_conteudo']);
            $dados['cms_pagina']['imagem_og'] = $dados['conteudos'][$key]['caminho_imagem_conteudo'] != '' || $dados['conteudos'][$key]['caminho_imagem_conteudo'] != null ? $dados['conteudos'][$key]['caminho_imagem_conteudo'] : BASE_URL . 'assets/images/logo-link.png?v='.VERSAO.'';
        }


        //SESSÃO DA LATERAL DIREITA DA TELA, POSTS RECENTES 
        $dados['posts_recentes'] = CmsPagina::select("*")
            ->join('cms_pagina_conteudo', 'cms_pagina.cod_pagina', '=', 'cms_pagina_conteudo.cod_pagina')
            ->join('cms_pagina_conteudo_imagem', 'cms_pagina_conteudo.cod_pagina_conteudo', '=', 'cms_pagina_conteudo_imagem.cod_pagina_conteudo')
            ->where('cms_pagina.cod_pagina_tipo', '=', 2)
            ->where('cms_pagina.campo_custom2', '=', 0)
            ->selectRaw('COUNT(*) OVER () as total_registros')
            ->orderBy('data_cadastro_pagina', 'asc')
            ->limit(3)
            ->get()
            ->toArray();

        //Adicionano data para o post recentes
        $urlEncode = new UrlEncode();

        //Adicionano data para o post recentes
        foreach ($dados['posts_recentes'] as $key => $item) {
            $dados['posts_recentes'][$key]['data_extenso_blog'] = $helper->retornarDataPorExtensoBlog($item['data_cadastro_pagina']);
            $dados['posts_recentes'][$key]['url_amigavel'] = $urlEncode->amigavelURL($item['titulo_pagina']);
        }


        foreach ($dados['posts_recentes'] as $key => $item) {
            $dados['posts_recentes'][$key]['data_extenso_blog'] = $helper->retornarDataPorExtensoBlog($item['data_cadastro_pagina']);
            $dados['posts_recentes'][$key]['url_amigavel'] = $urlEncode->amigavelURL($item['titulo_pagina']);
        }




        //SESSÃO DA LATERAL DIREITA DA TELA, POSTS RECENTES 
        $dados['posts_destaques'] = CmsPagina::select("*")
            ->join('cms_pagina_conteudo', 'cms_pagina.cod_pagina', '=', 'cms_pagina_conteudo.cod_pagina')
            ->join('cms_pagina_conteudo_imagem', 'cms_pagina_conteudo.cod_pagina_conteudo', '=', 'cms_pagina_conteudo_imagem.cod_pagina_conteudo')
            ->where('cms_pagina.cod_pagina_tipo', '=', 2)
            ->where('cms_pagina.campo_custom2', '=', 1)
            ->selectRaw('COUNT(*) OVER () as total_registros')
            ->orderBy('data_cadastro_pagina', 'asc')
            ->limit(3)
            ->get()
            ->toArray();

        //Adicionano data para o post recentes
        foreach ($dados['posts_destaques'] as $key => $item) {
            $dados['posts_destaques'][$key]['data_extenso_blog'] = $helper->retornarDataPorExtensoBlog($item['data_cadastro_pagina']);
            $dados['posts_destaques'][$key]['url_amigavel'] = $urlEncode->amigavelURL($item['titulo_pagina']);
        }


        $dados['cms_pagina']['favicon'] = $dados['configuracoes']['favicon'];
        
        $this->render('blog-detalhe', $dados);
    }

}