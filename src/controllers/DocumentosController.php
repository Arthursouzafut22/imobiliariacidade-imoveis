<?php

namespace src\controllers;

use \core\Controller;
use src\handlers\Helper;
use src\models\CmsConfiguracao;
use src\models\CmsPagina;
use src\models\CmsPaginaConteudo;
use src\models\CmsPaginaConteudoImagem;
use src\models\CmsScriptsExternos;


class DocumentosController extends Controller {

    public function __construct(){
        $conf =  CmsConfiguracao::first()->toArray();
        Helper::siteEmManutencao( $conf);
    }

    public function index() {
        $dados = [];
        
        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();

        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
        ->where('cod_pagina_conteudo', 45)
        ->orderBy('ordem_imagem_conteudo', 'asc')
        ->get()
        ->toArray();
        
        $dados['script'] = CmsScriptsExternos::first()->toArray();

        $dados['cms_pagina'] = CmsPagina::select("*")
        ->where('cms_pagina.cod_pagina', 8)
        ->join('cms_pagina_conteudo', 'cms_pagina.cod_pagina', 'cms_pagina_conteudo.cod_pagina')
        ->first()
        ->toArray();

        //seto a logo no cms_pagina, pra usar isso no include de metatags
        $dados['cms_pagina']['logo'] = $dados['configuracoes']['logo'];
        
        $dados['banner'] = CmsPaginaConteudoImagem::select("*")
        ->where('cms_pagina_conteudo_imagem.cod_pagina_conteudo', 30)
        ->join('cms_pagina_conteudo', 'cms_pagina_conteudo.cod_pagina_conteudo', 'cms_pagina_conteudo_imagem.cod_pagina_conteudo')
        ->first()
        ->toArray();

        $dados['texto'] = CmsPaginaConteudo::select("*")
        ->where('cod_pagina_conteudo', 62)
        ->first()
        ->toArray();


        $this->render('documentos', $dados);
    }
}
