<?php

namespace src\controllers;

use \core\Controller;
use src\handlers\Helper;
use src\models\CmsConfiguracao;
use src\models\CmsPagina;
use src\models\CmsPaginaConteudoImagem;
use src\models\CmsScriptsExternos;
use \src\models\Configuracoe;
use \src\models\Script;


class PoliticaController extends Controller {

    public function __construct(){
        $conf =  CmsConfiguracao::first()->toArray();
        Helper::siteEmManutencao( $conf);
    }
    
    public function index() {
        $dados = [];

        $dados['script'] = CmsScriptsExternos::first()->toArray();

        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();

        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
        ->where('cod_pagina_conteudo', 45)
        ->orderBy('ordem_imagem_conteudo', 'asc')
        ->get()
        ->toArray();
        
        $dados['cms_pagina'] = CmsPagina::select("*")
        ->where('cms_pagina.cod_pagina', 9)
        ->join('cms_pagina_conteudo', 'cms_pagina.cod_pagina', 'cms_pagina_conteudo.cod_pagina')
        ->first()
        ->toArray();

        $dados['cms_pagina']['favicon'] = $dados['configuracoes']['favicon'];

        $this->render('politica', $dados);
    }

}
