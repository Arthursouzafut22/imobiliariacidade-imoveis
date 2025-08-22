<?php

namespace src\controllers;

use \core\Controller;
use src\handlers\Email;
use src\handlers\Helper;
use src\handlers\PHPMailer;
use src\models\CmsConfiguracao;
use src\models\CmsPagina;
use src\models\CmsPaginaConteudo;
use src\models\CmsPaginaConteudoImagem;
use src\models\CmsScriptsExternos;
use \src\models\Configuracoe;
use \src\models\Script;


class OuvidoriaController extends Controller
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
            ->where('cod_pagina', 12)
            ->first()
            ->toArray();

        //seto a logo no cms_pagina, pra usar isso no include de metatags
        $dados['cms_pagina']['logo'] = $dados['configuracoes']['logo'];

        $dados['texto'] = CmsPaginaConteudo::select("*")
            ->where('cod_pagina_conteudo', 43)
            ->first()
            ->toArray();

        $dados['banner'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 63)
            ->first()
            ->toArray();

        $dados['texto_ouvidoria'] = CmsPaginaConteudo::select("*")
            ->where('cod_pagina_conteudo', 43)
            ->first()
            ->toArray();

        $dados['cms_pagina']['favicon'] = $dados['configuracoes']['favicon'];


        $this->render('ouvidoria', $dados);
    }

    public function enviarOuvidoria()
    {

        $configuracoes = CmsConfiguracao::first()->toArray();
        $dados = $_POST;

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

        $dados['midia'] = (isset($_COOKIE['midia_origem']) ? $_COOKIE['midia_origem'] : 'site');
        $dados['campanha'] = (isset($_COOKIE['utm_campaign']) ? $_COOKIE['utm_campaign'] : 'site');
        $dados['utm'] = isset($_COOKIE['utm_source']) ? $_COOKIE['utm_source'] : 'site';

        $dados['destinatario'] = $configuracoes['email_destinatario_configuracao'];
        $dados['assunto'] = "Ouvidoria - " . $configuracoes['nome_imobiliaria'];
        $dados['emailresposta'] = $configuracoes['email_resposta_configuracao'];
        $dados['nomeresposta'] = $configuracoes['email_remetente_configuracao'];
        $dados['email_remetente_configuracao'] = $configuracoes['email_remetente_configuracao'];
        $dados['email_remetente_porta_configuracao'] = $configuracoes['email_remetente_porta_configuracao'];
        $dados['email_remetente_smtp_configuracao'] = $configuracoes['email_remetente_smtp_configuracao'];
        $dados['email_remetente_senha_configuracao'] = $configuracoes['email_remetente_senha_configuracao'];

        $dados['arquivo'] = (isset($_FILES['arquivo']) || !empty($_FILES['arquivo']) ? $_FILES['arquivo'] : []);

        $corpo = [
            'nome' => ['Nome' => $dados['nome']],
            'sobrenome' => ['Sobrenome' => $dados['sobrenome']],
            'telefone' => ['telefone' => $dados['telefone']],
            'email' => ['Email' => $dados['email']],
            'motivo' => ['Motivo' => $dados['motivo']],
            'mensagem' => ['Mensagem' => $dados['mensagem']],
            'endereco' => ['Endereço' => $dados['endereco']],
            'midia' => ['Mídia' => (isset($_COOKIE['midia_origem']) ? $_COOKIE['midia_origem'] : 'site')],
            'campanha' => ['Campanha' => (isset($_COOKIE['utm_campaign']) ? $_COOKIE['utm_campaign'] : 'site')],
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
