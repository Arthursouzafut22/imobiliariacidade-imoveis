<?php

namespace src\controllers;

use src\handlers\Email;
use src\handlers\Helper;
use src\models\CmsConfiguracao;
use src\models\CmsPagina;
use src\models\CmsPaginaConteudo;
use src\models\CmsPaginaConteudoImagem;
use src\models\CmsRedeSocial;
use src\models\CmsScriptsExternos;
use src\models\Contato;
use \core\Controller;

class ContatoController extends Controller
{
    public function __construct()
    {
        $conf = CmsConfiguracao::first()->toArray();
        Helper::siteEmManutencao($conf);
    }

    public function index()
    {
        $dados = [];

        $dados['script'] = CmsScriptsExternos::first()->toArray();
        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();

        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 45)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();

        $dados['cms_pagina'] = CmsPagina::select("*")
            ->where('cms_pagina.cod_pagina', 2)
            ->join('cms_pagina_conteudo', 'cms_pagina.cod_pagina', 'cms_pagina_conteudo.cod_pagina')
            ->first()
            ->toArray();

        //seto a logo no cms_pagina, pra usar isso no include de metatags
        $dados['cms_pagina']['logo'] = $dados['configuracoes']['logo'];

        $dados['banner'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 60)
            ->first()
            ->toArray();

        $dados['depoimentos'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 54)
            ->get()
            ->toArray();
        $dados['titulo_depoimentos'] = CmsPaginaConteudo::where('cod_pagina_conteudo', 54)
            ->value('titulo_conteudo');

        /*
        $dados['diferenciais'] = CmsPaginaConteudoImagem::select("*")
        ->where('cms_pagina_conteudo_imagem.cod_pagina_conteudo', 5)
        ->join('cms_pagina_conteudo', 'cms_pagina_conteudo.cod_pagina_conteudo', 'cms_pagina_conteudo_imagem.cod_pagina_conteudo')
        ->get()
        ->toArray();

        $dados['sobre_nos'] = CmsPaginaConteudoImagem::select("*")
        ->where('cod_pagina_conteudo', 9)
        ->first()
        ->toArray();
        */

        $dados['cms_pagina']['favicon'] = $dados['configuracoes']['favicon'];

        $this->render('contato', $dados);
    }

    public function enviarFormulario()
    {
        $configuracoes = CmsConfiguracao::first()->toArray();
        $dados = $this->getRequestData();

        //valida o captcha
        if ($configuracoes['captcha_ativo']) {
            $reposta_capcha = Helper::validarCaptcha($dados['g_recaptcha'], $configuracoes['captcha_secret_key']);
            if ($reposta_capcha[0] == false) {
                header('Content-Type: application/json');
                echo json_encode(['mensagem' => $reposta_capcha[1], 'status' => false]);
                exit;
            }
        }

        //remover informação da chave
        unset($dados['g_recaptcha']);

        $dados['destinatario'] = $configuracoes['email_destinatario_configuracao'];
        $dados['assunto'] = $configuracoes['nome_imobiliaria'] . " - Fale Conosco";
        $dados['emailresposta'] = $configuracoes['email_resposta_configuracao'];
        $dados['nomeresposta'] = $configuracoes['nome_imobiliaria'];
        $dados['email_remetente_configuracao'] = $configuracoes['email_remetente_configuracao'];
        $dados['email_remetente_porta_configuracao'] = $configuracoes['email_remetente_porta_configuracao'];
        $dados['email_remetente_smtp_configuracao'] = $configuracoes['email_remetente_smtp_configuracao'];
        $dados['email_remetente_senha_configuracao'] = $configuracoes['email_remetente_senha_configuracao'];


        $corpo = [
            'nome' => ['Nome' => $dados['nome']],
            'fixo' => ['Fixo' => $dados['fixo']],
            'email' => ['Telefone' => $dados['tel']],
            'anotacoes' => ['Anotações' => $dados['descricao']],
            'midia' => ['Mídia' => isset($_COOKIE['midia_origem']) ? $_COOKIE['midia_origem'] : 'site'],
            'campanha' => ['Campanha' => isset($_COOKIE['utm_campaign']) ? $_COOKIE['utm_campaign'] : 'site'],
            'utm' => ['Utm' => isset($_COOKIE['utm_source']) ? $_COOKIE['utm_source'] : 'site'],
        ];

        $dados['mensagem'] = Helper::gerarTabelaParaEnvioDeEmail($corpo, $dados['assunto'], $configuracoes['nome_imobiliaria']);

        $email = new Email();
        // SE A VARIAVEL $configuracoes['email_forma_envio_configuracao'] FOR ( 1 ) ENVIAR O E-MAIL SEM AUTENTICAÇÃO
        $response = ($configuracoes['email_forma_envio_configuracao'] ? $email->enviarEmailPHPmail($dados) : $email->enviarEmailSmtp($dados));

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
