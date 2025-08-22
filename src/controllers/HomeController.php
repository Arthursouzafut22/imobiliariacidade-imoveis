<?php

namespace src\controllers;

use src\handlers\Helper;
use src\models\CmsConfiguracao;
use src\models\CmsPagina;
use src\models\CmsPaginaConteudo;
use src\models\CmsPaginaConteudoImagem;
use src\models\CmsScriptsExternos;
use src\models\ImobBairro;
use \core\Controller;

class HomeController extends Controller
{
    public function __construct() {
        $conf =  CmsConfiguracao::first()->toArray();
        Helper::siteEmManutencao( $conf);
    }

    public function index()
    {

        $_SESSION[SESSION_UNIC] = [];

        $dados = [];

        $dados['script'] = CmsScriptsExternos::first()->toArray();
        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();
        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 45)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();

        $dados['cms_pagina'] = CmsPagina::select("*")
            ->where('cms_pagina.cod_pagina', 1)
            ->join('cms_pagina_conteudo', 'cms_pagina.cod_pagina', 'cms_pagina_conteudo.cod_pagina')
            ->first()
            ->toArray();

        //seto a logo no cms_pagina, pra usar isso no include de metatags
        $dados['cms_pagina']['logo'] = $dados['configuracoes']['logo'];
        $dados['cms_pagina']['favicon'] = $dados['configuracoes']['favicon'];

        $dados['banner'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 1)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->first()            
            ->toArray();

        //valido se o banner é desktop ou mobile
        if(DISPOSITIVO_MOBILE == true) {
            $codigoBanner = 52;
            // $dados['banner']['caminho_imagem_conteudo'] = "";
        } else {
            $codigoBanner = 49;
        }
        $dados['banners_carrossel'] = CmsPaginaConteudoImagem::select("*")
            ->join('cms_pagina_conteudo', 'cms_pagina_conteudo_imagem.cod_pagina_conteudo', 'cms_pagina_conteudo.cod_pagina_conteudo')
            ->where('cms_pagina_conteudo_imagem.cod_pagina_conteudo', $codigoBanner)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();

        $dados['destaques'] = CmsPaginaConteudo::select("*")
        ->where('cod_pagina_conteudo', 2)
        ->first()
        ->toArray();

        // $dados['carrossel_blog_pagina'] = CmsPaginaConteudo::select("*")
        // ->where('cod_pagina_conteudo', 50)
        // ->first()
        // ->toArray();

        $dados['carrossel_blog'] = CmsPagina::select("*")
        ->join('cms_pagina_conteudo', 'cms_pagina.cod_pagina', '=', 'cms_pagina_conteudo.cod_pagina')
        ->join('cms_pagina_conteudo_imagem', 'cms_pagina_conteudo.cod_pagina_conteudo', '=', 'cms_pagina_conteudo_imagem.cod_pagina_conteudo')
        ->where('cms_pagina.cod_pagina_tipo', '=', 2)
        ->selectRaw('COUNT(*) OVER () as total_registros')
        ->orderBy('data_cadastro_pagina', 'asc')
        ->limit(6)
        ->get()
        ->toArray();

        $dados['carrossel_busca_rapida'] = Helper::retornarBuscasProntasPorBairro(51);
        
        $dados['carrossel_busca_rapida'] = CmsPaginaConteudoImagem::select("*")
        ->join('cms_pagina_conteudo', 'cms_pagina_conteudo_imagem.cod_pagina_conteudo', 'cms_pagina_conteudo.cod_pagina_conteudo')
        ->where('cms_pagina_conteudo_imagem.cod_pagina_conteudo', 51)
        ->get()
        ->toArray();

        $dados['carrossel_busca_rapida_conteudo'] = CmsPaginaConteudo::select("*")
        ->where('cod_pagina_conteudo', 51)
        ->first()
        ->toArray();

        // titulo mais filtros
        $dados['conteudo_textos_buscas_prontas'] = CmsPagina::select(["titulo_pagina", "subtitulo_pagina"])
        ->where('cod_pagina', 33)
        ->first()
        ->toArray();

        // Lista de bairros com filtro para comprar
        $dados['lista_buscas_venda_bairro1'] = Helper::retornarBuscasProntasPorBairro(67);
        $dados['lista_buscas_venda_bairro2'] = Helper::retornarBuscasProntasPorBairro(68);
        $dados['lista_buscas_venda_bairro3'] = Helper::retornarBuscasProntasPorBairro(69);
        $dados['lista_buscas_venda_bairro4'] = Helper::retornarBuscasProntasPorBairro(70);
        $dados['lista_buscas_venda_bairro5'] = Helper::retornarBuscasProntasPorBairro(124);
        $dados['lista_buscas_venda_bairro6'] = Helper::retornarBuscasProntasPorBairro(125);
        $dados['lista_buscas_venda_bairro7'] = Helper::retornarBuscasProntasPorBairro(126);
        $dados['lista_buscas_venda_bairro8'] = Helper::retornarBuscasProntasPorBairro(127);
        $dados['lista_buscas_venda_bairro9'] = Helper::retornarBuscasProntasPorBairro(128);
        $dados['lista_buscas_venda_bairro10'] = Helper::retornarBuscasProntasPorBairro(129);
        $dados['lista_buscas_venda_bairro11'] = Helper::retornarBuscasProntasPorBairro(130);
        $dados['lista_buscas_venda_bairro12'] = Helper::retornarBuscasProntasPorBairro(131);

        $dados['lista_buscas_locacao_bairro1'] = Helper::retornarBuscasProntasPorBairro(78);
        $dados['lista_buscas_locacao_bairro2'] = Helper::retornarBuscasProntasPorBairro(79);
        $dados['lista_buscas_locacao_bairro3'] = Helper::retornarBuscasProntasPorBairro(80);
        $dados['lista_buscas_locacao_bairro4'] = Helper::retornarBuscasProntasPorBairro(81);
        $dados['lista_buscas_locacao_bairro5'] = Helper::retornarBuscasProntasPorBairro(132);
        $dados['lista_buscas_locacao_bairro6'] = Helper::retornarBuscasProntasPorBairro(133);
        $dados['lista_buscas_locacao_bairro7'] = Helper::retornarBuscasProntasPorBairro(134);
        $dados['lista_buscas_locacao_bairro8'] = Helper::retornarBuscasProntasPorBairro(135);
        $dados['lista_buscas_locacao_bairro9'] = Helper::retornarBuscasProntasPorBairro(136);
        $dados['lista_buscas_locacao_bairro10'] = Helper::retornarBuscasProntasPorBairro(137);
        $dados['lista_buscas_locacao_bairro11'] = Helper::retornarBuscasProntasPorBairro(138);
        $dados['lista_buscas_locacao_bairro12'] = Helper::retornarBuscasProntasPorBairro(139);
        
        $b = new ImobBairro();

        $bairrosVenda = explode(',', BAIRROS_HOME_VENDA);
        $tiposArrayVenda = array_map('intval', explode(',', TIPOS_BAIRROS_HOME_VENDA));

        $bairrosAluguel = explode(',', BAIRROS_HOME_LOCACAO);
        $tiposArrayAluguel = array_map('intval', explode(',', TIPOS_BAIRROS_HOME_LOCACAO));

    
        $URLS = [];
        foreach ($bairrosVenda as $bairro) {

            $resultado = $b->retornarBuscaBairros(2, $bairro, $tiposArrayVenda);

            if (!empty($resultado)) { // Só adiciona se não estiver vazio
                $URLS[] = $resultado;
            }
        }

        $dados['principais_pesquisas_venda'] = $URLS;
        
        $URLS_ALUGUEL = [];
        foreach ($bairrosAluguel as $bairro) {

            $resultado = $b->retornarBuscaBairros(1, $bairro, $tiposArrayAluguel);

            if (!empty($resultado)) { // Só adiciona se não estiver vazio
                $URLS_ALUGUEL[] = $resultado;
            }
        }

        $dados['principais_pesquisas_aluguel'] = $URLS_ALUGUEL;

        // echo '<pre>';
        // echo json_encode(array_keys($dados['principais_pesquisas'][0])[0], JSON_PRETTY_PRINT); exit;



        // ABAIXO NAO ESTA SENDO UTILIZADO -------------------------------------------------------------------------------------------
        /*
        $dados['depoimentos'] = CmsPaginaConteudoImagem::select("*")
        ->where('cod_pagina_conteudo', 54)
        ->get()
        ->toArray();

        $dados['banner_anuncie'] = CmsPaginaConteudoImagem::select("*")
        ->where('cod_pagina_conteudo', 3)
        ->first()
        ->toArray();

        $dados['diferenciais'] = CmsPaginaConteudoImagem::select("*")
        ->where('cms_pagina_conteudo_imagem.cod_pagina_conteudo', 5)
        ->join('cms_pagina_conteudo', 'cms_pagina_conteudo.cod_pagina_conteudo', 'cms_pagina_conteudo_imagem.cod_pagina_conteudo')
        ->get()
        ->toArray();

        $dados['bairros_destaque'] = CmsPaginaConteudoImagem::select("*")
        ->where('cms_pagina_conteudo_imagem.cod_pagina_conteudo', 6)
        ->join('cms_pagina_conteudo', 'cms_pagina_conteudo.cod_pagina_conteudo', 'cms_pagina_conteudo_imagem.cod_pagina_conteudo')
        ->get()
        ->toArray();
        */
        
        $this->render('home', $dados);
    }
}
