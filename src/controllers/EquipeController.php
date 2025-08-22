<?php

namespace src\controllers;

use src\handlers\Helper;
use src\models\CmsConfiguracao;
use src\models\CmsPagina;
use src\models\CmsPaginaConteudo;
use src\models\CmsPaginaConteudoImagem;
use src\models\CmsScriptsExternos;
use \src\models\Equipe;
use \src\models\Configuracoe;
use \core\Controller;
use \src\models\Script;


class EquipeController extends Controller
{

    public function __construct(){
        $conf =  CmsConfiguracao::first()->toArray();
        Helper::siteEmManutencao( $conf);
    }
    
    public function index()
    {
        header("Content-type:text/html; charset=utf-8");

        $dados = [];

        $dados['script'] = CmsScriptsExternos::first()->toArray();
        
        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();

        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
        ->where('cod_pagina_conteudo', 45)
        ->orderBy('ordem_imagem_conteudo', 'asc')
        ->get()
        ->toArray();
        
        $dados['cms_pagina'] = CmsPagina::select("*")
        ->where('cms_pagina.cod_pagina', 7)
        ->join('cms_pagina_conteudo', 'cms_pagina.cod_pagina', 'cms_pagina_conteudo.cod_pagina')
        ->first()
        ->toArray();

        $dados['titulo_diretoria'] = CmsPaginaConteudo::select("*")
        ->where('cod_pagina_conteudo', 28)
        ->first()
        ->toArray();

        $dados['banner'] = CmsPaginaConteudoImagem::select("*")
        ->where('cod_pagina_conteudo', 64)
        ->first()
        ->toArray();

        $dados['conteudo_galeria_diretoria'] = CmsPaginaConteudo::select("*")
        ->where('cod_pagina_conteudo', 28)
        ->first()
        ->toArray();

        $dados['conteudo_galeria_corretores'] = CmsPaginaConteudo::select("*")
        ->where('cod_pagina_conteudo', 29)
        ->first()
        ->toArray();

        $dados['galeria_diretoria'] = CmsPaginaConteudoImagem::select("*")
        ->where('cod_pagina_conteudo', 28)
        ->get()
        ->toArray();

        $dados['galeria_corretores'] = CmsPaginaConteudoImagem::select("*")
        ->where('cod_pagina_conteudo', 29)
        ->get()
        ->toArray();
        
        $this->render('equipe', $dados);
    }

    public function retornarDetalhesColaborador(){
        $dados = [];

        $data = $this->getRequestData();

        $dados['dados_colaborador'] = CmsPaginaConteudoImagem::select("*")
        ->where('cod_imagem_conteudo', $data['codconteudo'])
        ->first()
        ->toArray();
        
        // $dados['nome'] = $dados['nome'];
        // $dados['descricao'] = $dados['descricao'];
        
        header('Content-Type: application/json');
        echo json_encode($dados['dados_colaborador']);
    }
}