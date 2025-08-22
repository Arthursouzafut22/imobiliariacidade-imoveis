<?php

namespace src\controllers;

use \core\Controller;
use src\handlers\Helper;
use src\models\CmsConfiguracao;
use src\models\CmsPagina;
use src\models\CmsPaginaConteudoImagem;
use src\models\CmsScriptsExternos;
use \src\handlers\Email;

class TrabalheConoscoController extends Controller
{
    public function __construct()
    {
        $conf = CmsConfiguracao::first()->toArray();
        Helper::siteEmManutencao($conf);
    }

    public function index()
    {
        $dados = [];

        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();
        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 42)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();

        $dados['script'] = CmsScriptsExternos::first()->toArray();

        $dados['cms_pagina'] = CmsPagina::select("*")
            ->where('cms_pagina.cod_pagina', 10)
            ->join('cms_pagina_conteudo', 'cms_pagina.cod_pagina', 'cms_pagina_conteudo.cod_pagina')
            ->first()
            ->toArray();

        // pego o banner principal da pagina
        $dados['banner'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 66) // 66 = banner imagem
            ->first()
            ->toArray();

        $dados['cms_pagina']['favicon'] = $dados['configuracoes']['favicon'];

        $this->render('trabalhe-conosco', $dados);
    }


    public function trabalheConoscoFormEnviarCurriculo()
    {

        $param = $_POST;
        $configuracoes = CmsConfiguracao::first()->toArray();

        if ($configuracoes['captcha_ativo']) {
            $reposta_capcha = Helper::validarCaptcha($param['g_recaptcha'], $configuracoes['captcha_secret_key']);
            if ($reposta_capcha[0] == false) {
                header('Content-Type: application/json');
                echo json_encode(['mensagem' => $reposta_capcha[1], 'status' => false]);
                exit;
            }
        }

        //remover informação da chave
        unset($param['g_recaptcha']);

        // Verifica se o arquivo foi enviado corretamente
        if (!isset($_FILES['arquivo']) || $_FILES['arquivo']['error'] !== UPLOAD_ERR_OK) {

            header('Content-Type: application/json');
            echo json_encode(["status" => false, "mensagem" => "Nenhum arquivo foi enviado ou houve um erro no upload."]);
            exit;
        }

        //valido o arquivo
        $responseAnexo = Helper::validarAnexo($_FILES['arquivo']);

        if ($responseAnexo == false) {
            header('Content-Type: application/json');
            echo json_encode(["status" => false, "mensagem" => "Extensão de arquivo não permitida. Apenas PDF, DOC, DOCX, JPG e PNG são aceitos."]);
            exit;
        }

        //monta o corpo do email
        $corpo = [
            'nome' => ['Nome' => $param['nome']],
            'sobrenome' => ['Sobrenome' => $param['sobrenome']],
            'telefone' => ['Telefone' => $param['telefone']],
            'cpf' => ['Cpf' => $param['cpf']],
            'vaga' => ['Vaga' => $param['vaga']],
            'midia' => ['Mídia' => isset($_COOKIE['midia_origem']) ? $_COOKIE['midia_origem'] : 'site'],
            'campanha' => ['Campanha' => isset($_COOKIE['utm_campaign']) ? $_COOKIE['utm_campaign'] : 'site'],
            'utm' => ['Utm' => isset($_COOKIE['utm_source']) ? $_COOKIE['utm_source'] : 'site'],
        ];

        $param['destinatario'] = $configuracoes['email_destinatario_configuracao'];
        $param['assunto'] = $configuracoes['nome_imobiliaria'] . " - Trabalhe Conosco";
        $param['emailresposta'] = $configuracoes['email_resposta_configuracao'];
        $param['email_remetente_configuracao'] = $configuracoes['email_remetente_configuracao'];
        $param['email_remetente_porta_configuracao'] = $configuracoes['email_remetente_porta_configuracao'];
        $param['email_remetente_smtp_configuracao'] = $configuracoes['email_remetente_smtp_configuracao'];
        $param['email_remetente_senha_configuracao'] = $configuracoes['email_remetente_senha_configuracao'];

        $param['mensagem'] = Helper::gerarTabelaParaEnvioDeEmail($corpo, $param['assunto'], $configuracoes['nome_imobiliaria']);
        $param['arquivo'] = (isset($_FILES['arquivo']) || !empty($_FILES['arquivo']) ? $_FILES['arquivo'] : []);

        $param['midia'] = (isset($_COOKIE['midia_origem']) ? $_COOKIE['midia_origem'] : 'site');
        $param['campanha'] = (isset($_COOKIE['utm_campaign']) ? $_COOKIE['utm_campaign'] : 'site');
        $param['utm'] = isset($_COOKIE['utm_source']) ? $_COOKIE['utm_source'] : 'site';

        $email = new Email();
        // SE A VARIAVEL $configuracoes['email_forma_envio_configuracao'] FOR ( 1 ) ENVIAR O E-MAIL SEM AUTENTICAÇÃO
        $response = ($configuracoes['email_forma_envio_configuracao'] ? $email->enviarEmailPHPmail($param) : $email->enviarEmailSmtp($param));

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
