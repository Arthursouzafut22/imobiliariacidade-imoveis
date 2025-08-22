<?php

namespace src\controllers;

use \core\Controller;
use src\handlers\Helper;
use src\models\CmsConfiguracao;
use src\models\CmsPagina;
use src\models\CmsPaginaConteudo;
use src\models\CmsPaginaConteudoImagem;
use src\models\CmsScriptsExternos;
class ObrigadoController extends Controller
{

    public function __construct(){
        $conf =  CmsConfiguracao::first()->toArray();
        Helper::siteEmManutencao( $conf);
    }
    
    public function index($params)
    {
        $dados = [];

        $dados['script'] = CmsScriptsExternos::first()->toArray();
        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();

        //pego os dados da pagina
        $dados['cms_pagina'] = CmsPagina::select("*")
        ->where('cod_pagina', 15)
        ->first()
        ->toArray();

        //seto a logo no cms_pagina, pra usar isso no include de metatags
        $dados['cms_pagina']['logo'] = $dados['configuracoes']['logo'];
        $dados['cms_pagina']['favicon'] = $dados['configuracoes']['favicon'];

        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
        ->where('cod_pagina_conteudo', 45)
        ->orderBy('ordem_imagem_conteudo', 'asc')
        ->get()
        ->toArray();

        $dados['conteudo'] = CmsPaginaConteudo::select(['titulo_conteudo', 'descricao_conteudo'])
        ->leftjoin('cms_pagina', 'cms_pagina_conteudo.cod_pagina', 'cms_pagina.cod_pagina')
        ->where('cms_pagina_conteudo.cod_pagina_conteudo', $params['codigo'])
        ->where('cms_pagina.cod_pagina', 15)
        ->first();
        // ->toArray();

        if ($dados['conteudo']) {
            $dados['conteudo'] = $dados['conteudo']->toArray();

        }else{

            $dados['cms_pagina']['titulo_pagina'] =  'Página não encontrada';

            header("HTTP/1.1 410 Gone");
            $this->render('404', $dados);
        }



        $this->render('obrigado', $dados);
    }

    public function obrigadoAnuncie()
    {
        $dados = [];

        $dados['script'] = CmsScriptsExternos::first()->toArray();
        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();
        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 45)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();

        $this->render('obrigado-anunciar', $dados);
    }

    public function captacao()
    {
        $dados = [];
        $dados['script'] = CmsScriptsExternos::first()->toArray();
        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();
        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 45)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();
        $this->render('obrigado-captacao', $dados);
    }


    public function obrigadoImovelIdeal()
    {
        $dados = [];
        $dados['script'] = CmsScriptsExternos::first()->toArray();
        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();
        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 45)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();

        $this->render('obrigado-imovel-ideal', $dados);
    }

    public function obrigadoContato()
    {
        $dados = [];

        $dados['script'] = CmsScriptsExternos::first()->toArray();
        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();
        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 45)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();

        $this->render('obrigado-contato', $dados);
    }

    public function obrigadoAgenda()
    {
        $dados = [];

        $dados['script'] = CmsScriptsExternos::first()->toArray();
        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();
        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 45)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();


        $this->render('obrigado-agenda', $dados);

    }

    public function obrigadoFaleCorretor()
    {
        $dados = [];
        $dados['script'] = CmsScriptsExternos::first()->toArray();
        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();
        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 45)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();

        $this->render('obrigado-lead', $dados);

    }
    public function obrigadoCurriculo()
    {
        $dados = [];

        $dados['script'] = CmsScriptsExternos::first()->toArray();
        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();
        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 45)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();

        $this->render('obrigado-curriculo', $dados);

    }

    public function obrigadoCondominio()
    {
        $dados = [];

        $dados['script'] = CmsScriptsExternos::first()->toArray();
        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();
        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 45)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();

        $this->render('obrigado-condominio', $dados);

    }
}