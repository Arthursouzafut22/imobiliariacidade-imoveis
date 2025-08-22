<?php

namespace src\controllers;

use \core\Controller;

use src\handlers\Calendario;
use src\handlers\Agenda;
use \src\handlers\Email;
use src\handlers\Helper;
use src\models\AgendaDAO;
use src\models\CmsConfiguracao;

class AgendaController extends Controller
{

    public function index()
    {
    }

    public function getCalendario()
    {

        $calendario = new Calendario();
        $agenda = $calendario->getCalendario();

        header('Content-Type: application/json');
        echo json_encode($agenda);

    }

    public function getHorarios()
    {
        $agenda = new Agenda();
        $agenda->setCodigoimovel($_POST['codigoimovel']);
        $agenda->setData($_POST['data']);
        
        $ag = new AgendaDAO($agenda);
        $dados = $ag->retornarHorariosVisitasDisponiveis();

        header('Content-Type: application/json');
        echo json_encode($dados);
    }
    


    public function agendarVisita()
    {

        $params = $_POST;

        $configuracoes = CmsConfiguracao::first()->toArray();

        if ($configuracoes['captcha_ativo']) {
            $reposta_capcha = Helper::validarCaptcha($params['g_recaptcha'], $configuracoes['captcha_secret_key']);
            if ($reposta_capcha[0] == false) {
                header('Content-Type: application/json');
                echo json_encode(['mensagem' => $reposta_capcha[1], 'status' => false]);
                exit;
            }
        }
        
        //remover informação da chave
        unset($params['g_recaptcha']);

        $params['midia'] = (isset($_COOKIE['midia_origem']) ? $_COOKIE['midia_origem'] : 'site');
        $params['campanha'] = (isset($_COOKIE['utm_campaign']) ? $_COOKIE['utm_campaign'] : 'site');
        $params['utm'] = isset($_COOKIE['utm_source']) ? $_COOKIE['utm_source'] : 'site';

        $ag = new AgendaDAO(new Agenda());
        $resposta_agendamento = $ag->incluirAgendamento($params);
        
        
        $params['destinatario'] = $configuracoes['email_destinatario_configuracao'];
        $params['assunto'] = $configuracoes['nome_imobiliaria'] . " - Agendamento de visita no imóvel " . $params['codigo'];
        $params['emailresposta'] = $configuracoes['email_resposta_configuracao'];
        $params['descricao'] = $params['anotacoes'];
        $params['nomeresposta'] = $configuracoes['nome_imobiliaria'];
        $params['email_remetente_configuracao'] = $configuracoes['email_remetente_configuracao'];
        $params['email_remetente_porta_configuracao'] = $configuracoes['email_remetente_porta_configuracao'];
        $params['email_remetente_smtp_configuracao'] = $configuracoes['email_remetente_smtp_configuracao'];
        $params['email_remetente_senha_configuracao'] = $configuracoes['email_remetente_senha_configuracao'];

        $corpo = [
            'nome' => ['Nome' => $params['nome']],
            'email' => ['E-mail' => $params['email']],
            'telefone' => ['Telefone' => $params['telefone']],
            'anotacoes' => ['Anotações' => $params['anotacoes']],
            'codigoimovel' => ['Código Imóvel' => $params['codigoimovel']],
            'datahoraagendamentovisita' => ['Datae Hora' => $params['datahoraagendamentovisita']],
            'midia' => ['Midia' => $params['midia']],
            'campanha' => ['Anotações' => $params['campanha']],
            'utm' => ['UTM' => $params['utm']],
        ];

        $params['mensagem'] = Helper::gerarTabelaParaEnvioDeEmail($corpo, $params['assunto'], $params['nomeresposta']);

        $configuracoes = CmsConfiguracao::first()->toArray();

        $email = new Email();
        // SE A VARIAVEL $configuracoes['email_forma_envio_configuracao'] FOR ( 1 ) ENVIAR O E-MAIL SEM AUTENTICAÇÃO
        $response = ($configuracoes['email_forma_envio_configuracao'] ? $email->enviarEmailPHPmail($params) : $email->enviarEmailSmtp($params));

        header('Content-Type: application/json');
        echo json_encode($response);

    }

}