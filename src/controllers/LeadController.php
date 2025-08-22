<?php

namespace src\controllers;

use \core\Controller;
use src\handlers\Helper;
use src\handlers\Lead;
use src\models\CmsConfiguracao;
use src\models\LeadDAO;
use \src\handlers\Email;

class LeadController extends Controller {

    public function index() {
        
    }

    public function incluirLead() {

        $configuracoes = CmsConfiguracao::first()->toArray();

        $param = $_POST;

        if($configuracoes['captcha_ativo']){
            $reposta_capcha = Helper::validarCaptcha($param['g_recaptcha'], $configuracoes['captcha_secret_key']);

            if($reposta_capcha[0] == false){
                header('Content-Type: application/json');
                echo json_encode(['mensagem'=> $reposta_capcha[1], 'status'=> false]);
                exit;
            }
        }


        $param['midia'] = (isset($_COOKIE['midia_origem']) ? $_COOKIE['midia_origem'] : 'site' );
        $param['campanha'] = (isset($_COOKIE['utm_campaign']) ? $_COOKIE['utm_campaign'] : 'site' );
        $param['utm'] = isset($_COOKIE['utm_source']) ? $_COOKIE['utm_source'] : 'site';
        $param['destinatario'] = $configuracoes['email_destinatario_configuracao'];
        $param['assunto'] = $configuracoes['nome_imobiliaria']." - Detalhe do imóvel ".$param['codigoimovel'];
        

         //remover informação da chave
         unset($param['g_recaptcha']);

        $leadDao = new LeadDAO(new Lead());
        $lead = $leadDao->incluirLead($param);

        $param['emailresposta'] =  $configuracoes['email_resposta_configuracao'];
        $param['nomeresposta'] = $configuracoes['nome_imobiliaria'];

        $param['email_remetente_configuracao'] = $configuracoes['email_remetente_configuracao'];
        $param['email_remetente_senha_configuracao'] = $configuracoes['email_remetente_senha_configuracao'];
        $param['email_remetente_smtp_configuracao'] = $configuracoes['email_remetente_smtp_configuracao'];
        $param['email_remetente_porta_configuracao'] = $configuracoes['email_remetente_porta_configuracao'];
        $param['email_resposta'] = $configuracoes['email_resposta_configuracao'];
   
        $corpo = [
            'nome' => ['Nome' => $param['nome']],
            'telefone' => ['Telefone' => $param['telefone']],
            'email' => ['E-mail' => $param['email']],
            'anotacoes' => ['Anotações' => $param['anotacoes']],
            'codigoimovel' => ['Código Imóvel' => $param['codigoimovel']],
            'finalidade' => ['Finaliade' => $param['finalidade']],
            'midia' => ['Mídia' => $param['midia']],
            'campanha' => ['Campanha' => isset($_COOKIE['utm_campaign']) ? $_COOKIE['utm_campaign'] : 'site'],
            'utm' => ['Utm' => isset($_COOKIE['utm_source']) ? $_COOKIE['utm_source'] : 'site'],
            
        ];

        $param['mensagem'] = Helper::gerarTabelaParaEnvioDeEmail($corpo, $param['assunto'], $configuracoes['nome_imobiliaria']);

        $configuracoes = CmsConfiguracao::first()->toArray();
        
        $email = new Email();
        // SE A VARIAVEL $configuracoes['email_forma_envio_configuracao'] FOR ( 1 ) ENVIAR O E-MAIL SEM AUTENTICAÇÃO
        $response = ($configuracoes['email_forma_envio_configuracao'] ? $email->enviarEmailPHPmail($param) : $email->enviarEmailSmtp($param));

        
        header('Content-Type: application/json');
        echo json_encode($response);
    }

}
