<?php
namespace src\controllers;

use \core\Controller;
use src\models\CmsConfiguracao;
use src\models\CmsPagina;
use src\models\CmsPaginaConteudoImagem;
use src\models\CmsScriptsExternos;

class ErrorController extends Controller {

    public function index() {

        //pego os scripts externos
        $dados['script'] = CmsScriptsExternos::first()->toArray();

        //pego as configurações
        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();

        //pego as redes sociais
        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
        ->where('cod_pagina_conteudo', 45)
        ->orderBy('ordem_imagem_conteudo', 'asc')
        ->get()
        ->toArray();

        //seto a logo no cms_pagina, pra usar isso no include de metatags
        $dados['cms_pagina'] = CmsPagina::select("*")
        ->where('cms_pagina.cod_pagina',30)
        ->join('cms_pagina_conteudo', 'cms_pagina.cod_pagina', 'cms_pagina_conteudo.cod_pagina')
        ->first()
        ->toArray();

        $dados['cms_pagina']['logo'] = $dados['configuracoes']['logo'];

        header("HTTP/1.1 410 Gone");
        $this->render('404', $dados);
    }

}