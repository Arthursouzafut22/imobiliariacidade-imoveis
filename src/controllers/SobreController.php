<?php

namespace src\controllers;

use src\handlers\Helper;
use src\handlers\Video;
use src\models\CmsConfiguracao;
use src\models\CmsPagina;
use src\models\CmsPaginaConteudo;
use src\models\CmsPaginaConteudoImagem;
use src\models\CmsScriptsExternos;
use \core\Controller;

class SobreController extends Controller
{


    public function __construct()
    {
        $conf =  CmsConfiguracao::first()->toArray();
        Helper::siteEmManutencao($conf);
    }

    public function index()
    {
        $video = new Video();

        $dados = [];

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

        //pego os dados da pagina
        $dados['cms_pagina'] = CmsPagina::select("*")
            ->where('cod_pagina', 4)
            ->first()
            ->toArray();

        //seto a logo no cms_pagina, pra usar isso no include de metatags
        $dados['cms_pagina']['logo'] = $dados['configuracoes']['logo'];

        //pego o banner principal da pagina
        $dados['banner'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 14)
            ->first()
            ->toArray();

        //pego a imagem principal da pagina
        $dados['img_principal'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 53)
            ->first()
            ->toArray();

        //pego o texto da pagina
        $dados['texto'] = CmsPaginaConteudo::select("*")
            ->where('cod_pagina_conteudo', 20)
            ->first()
            ->toArray();

        //pego a galeria de imagens da página
        $dados['imagens_galeria'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 21)
            ->get()
            ->toArray();

        //pego o vídeo dessa página
        $dados['video'] = CmsPaginaConteudo::select("*")
            ->where('cod_pagina_conteudo', 23)
            ->first()
            ->toArray();

        $video = new Video();
        $dados['video']['url_video_conteudo'] = $video->tratarVideo($dados['video']['url_video_conteudo']);

        //pego os depoimentos da pagina
        $dados['depoimentos'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 54)
            ->get()
            ->toArray();

        $dados['titulo_depoimentos'] = CmsPaginaConteudo::where('cod_pagina_conteudo', 54)
            ->value('titulo_conteudo');

        $dados['cms_pagina']['favicon'] = $dados['configuracoes']['favicon'];

        $this->render('sobre', $dados);
    }
}
