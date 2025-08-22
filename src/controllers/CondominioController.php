<?php

namespace src\controllers;

use \core\Controller;
use src\handlers\Email;
use src\handlers\Helper;
use \src\handlers\Imovel;
use src\handlers\Lead;
use src\handlers\ToggleQueriesData;
use \src\handlers\UrlEncode;
use src\handlers\Video;
use src\models\CmsConfiguracao;
use src\models\CmsPagina;
use src\models\CmsPaginaConteudoImagem;
use src\models\CmsScriptsExternos;
use \src\models\EdificioDAO;
use \src\models\Condominio;
use \src\models\Condominiodetalhe;
use \src\models\Configuracoe;
use src\models\Imob_condominio;
use src\models\LeadDAO;
use \src\models\Script;


class CondominioController extends Controller
{

    public function __construct()
    {
        $conf = CmsConfiguracao::first()->toArray();
        Helper::siteEmManutencao($conf);
    }


    //DETALHE DO CONDOMINIO
    public function index($params)
    {

        $dados = [];

        $imo = new Imovel();
        $imo->setCodigocondominio($params['id']);

        $cond = new Imob_condominio();
        $retorno['imovel'] = $cond->retornarDetalheCondominiosDisponiveis($params['id']);

        if ($retorno['imovel'] == null) {

            $dados['configuracoes'] = CmsConfiguracao::first()->toArray();
            $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
                ->where('cod_pagina_conteudo', 45)
                ->orderBy('ordem_imagem_conteudo', 'asc')
                ->get()
                ->toArray();

            $dados['configuracoes']['ocultar_footer'] = true;
            $dados['script'] = CmsScriptsExternos::first()->toArray();
            $dados['configuracoes']['ocultar_footer'] = false;
            //seto a logo no cms_pagina, pra usar isso no include de metatags

            //seto a logo no cms_pagina, pra usar isso no include de metatags
            $dados['cms_pagina'] = CmsPagina::select("*")
                ->where('cms_pagina.cod_pagina', 30)
                ->join('cms_pagina_conteudo', 'cms_pagina.cod_pagina', 'cms_pagina_conteudo.cod_pagina')
                ->first()
                ->toArray();

            $dados['cms_pagina']['logo'] = $dados['configuracoes']['logo'];

            $dados['cms_pagina']['favicon'] = $dados['configuracoes']['favicon'];


            header("HTTP/1.1 410 Gone");
            $this->render('404', $dados);
            exit;
        }

        $url = new UrlEncode();

        $retorno['imovel']['url_amigavel'] = $url->amigavelURL($retorno['imovel']['nomecondominio']);
        $retorno['imovel']['url_bairro'] = $url->amigavelURL($retorno['imovel']['bairro']);
        $retorno['imovel']['url_cidade'] = $url->amigavelURL($retorno['imovel']['cidade']);
        $retorno['imovel']['fotos'] = json_decode($retorno['imovel']['fotos']);
        $retorno['imovel']['fotos360'] = json_decode($retorno['imovel']['fotos360']);
        $retorno['imovel']['unidadesaluguel'] = json_decode($retorno['imovel']['unidadesaluguel']);
        $retorno['imovel']['unidadesvenda'] = json_decode($retorno['imovel']['unidadesvenda']);
        $retorno['imovel']['extras2'] = json_decode($retorno['imovel']['extras2']);


        $retorno['imovel']['areaprincipal'] = Helper::tratarValoresEmpreendimentos($retorno['imovel']['areaprincipal']);
        $retorno['imovel']['arealote'] = Helper::tratarValoresEmpreendimentos($retorno['imovel']['arealote']);
        $retorno['imovel']['numeroquartos'] = Helper::tratarValoresEmpreendimentos($retorno['imovel']['numeroquartos']);
        $retorno['imovel']['numerobanhos'] = Helper::tratarValoresEmpreendimentos($retorno['imovel']['numerobanhos']);
        $retorno['imovel']['numerovagas'] = Helper::tratarValoresEmpreendimentos($retorno['imovel']['numerovagas']);
        $retorno['imovel']['numerosuites'] = Helper::tratarValoresEmpreendimentos($retorno['imovel']['numerosuites']);


        $retorno['imovel']['fotos'] = $retorno['imovel']['fotos'] == null ? [] : $retorno['imovel']['fotos'];
        $retorno['imovel']['fotos360'] = $retorno['imovel']['fotos360'] == null ? [] : $retorno['imovel']['fotos360'];

        if ($retorno['imovel']['urlvideo'] != '') {
            $v = new Video();
            $retorno['imovel']['urlvideo'] = $v->tratarVideo($retorno['imovel']['urlvideo']);
        }

        //CAMPOS PENDENTES
        $retorno['imovel']['estado'] = 'MG';
        $retorno['imovel'] = (object) $retorno['imovel'];

        $retorno['script'] = CmsScriptsExternos::first()->toArray();
        $retorno['configuracoes'] = CmsConfiguracao::first()->toArray();
        $retorno['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 45)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();


        //mensagem do WhatsApp
        $retorno['configuracoes']['mensagem_whatsapp'] = 'sobre o condomínio: ' . $params['id'];

        $retorno['cms_pagina']['titulo_pagina'] = $retorno['imovel']->nome;
        $retorno['cms_pagina']['meta_titulo_pagina'] = $retorno['imovel']->nome . ' no ' . $retorno['imovel']->bairro . " | " . $retorno['imovel']->cidade;
        $retorno['cms_pagina']['meta_descricao_pagina'] = 'Oportunidade de imóvel no empreenimento ' . $retorno['imovel']->nome . ' localizado no ' . $retorno['imovel']->bairro . " | " . $retorno['imovel']->cidade;
        $retorno['cms_pagina']['imagem_og'] = $retorno['imovel']->urlfotoprincipal;


        $retorno['cms_pagina']['favicon'] = $retorno['configuracoes']['favicon'];

        $this->render('condominio-detalhe', $retorno);
    }

    public function getCondominio()
    {
        header('Content-Type: application/json');
        echo json_encode($_SESSION['condominio']);
    }

    public function getCondominios()
    {

        $dados = [];

        $params = $this->getRequestData();
        $imo = new Imovel();

        $imo->setFinalidade($params['finalidade']);
        $imo->setRetornoReduzido($params['retornoReduzido']);
        $imo->setNumeroregistros($params['numeroregistros']);
        $imo->setNumeropagina($params['numeropagina']);

        $cond = new Imob_condominio($imo);

        $dados = $cond->retornarCondominiosDisponiveis();

        $url = new UrlEncode();
        foreach ($dados['lista'] as $key => $value) {
            $dados['lista'][$key]['url_amigavel'] = $url->amigavelURL($value['nome']);
        }

        header('Content-Type: application/json');
        echo json_encode($dados);
    }

    public function getCondominiosPaginacao()
    {

        $dados = [];

        $params = $this->getRequestData();
        $cond = new Imob_condominio(new Imovel());
        $dados = $cond->retornarCondominiosDisponiveisPaginacao($params);

        $url = new UrlEncode();
        foreach ($dados['lista'] as $key => $value) {
            $dados['lista'][$key]['url_amigavel'] = $url->amigavelURL($value['nome']);
        }


        if (isset($dados['lista'][0]['total_registros'])) {

            $dados['quantidade'] = $dados['lista'][0]['total_registros'];
        } else {
            $dados['quantidade'] = 0;
        }

        $dados['numeropagina'] = $params['numeropagina'];


        header('Content-Type: application/json');
        echo json_encode($dados);
    }
    public function condominiosView()
    {
        $dados['cms_pagina'] = CmsPagina::select("*")
            ->where('cms_pagina.cod_pagina', 14)
            ->join('cms_pagina_conteudo', 'cms_pagina.cod_pagina', 'cms_pagina_conteudo.cod_pagina')
            ->first()
            ->toArray();

        $dados['banner'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 48)
            ->first()
            ->toArray();


        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();
        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 45)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();

        $dados['script'] = CmsScriptsExternos::first()->toArray();

        $dados['cms_pagina']['favicon'] = $dados['configuracoes']['favicon'];


        $this->render('lista-condominios', $dados);
    }
    public function enviarLead()
    {

        $dados = $_POST;
        $configuracoes = CmsConfiguracao::first()->toArray();
        
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

        $leadDao = new LeadDAO(new Lead());
        $lead = $leadDao->incluirLead($dados);

        $dados['destinatario'] = $configuracoes['email_destinatario_configuracao'];
        $dados['assunto'] = $configuracoes['nome_imobiliaria'] . " - Página detalhe do condomínio";
        $dados['emailresposta'] = $configuracoes['email_resposta_configuracao'];
        $dados['descricao'] = $dados['anotacoes'];

        $dados['nomeresposta'] = $configuracoes['nome_imobiliaria'];
        $dados['email_remetente_configuracao'] = $configuracoes['email_remetente_configuracao'];
        $dados['email_remetente_porta_configuracao'] = $configuracoes['email_remetente_porta_configuracao'];
        $dados['email_remetente_smtp_configuracao'] = $configuracoes['email_remetente_smtp_configuracao'];
        $dados['email_remetente_senha_configuracao'] = $configuracoes['email_remetente_senha_configuracao'];

        $corpo = [
            'nome' => ['Nome' => $dados['nome']],
            'telefone' => ['Telefone' => $dados['telefone']],
            'email' => ['E-mail' => $dados['email']],
            'anotacoes' => ['Anotações' => $dados['anotacoes']],
            'codigoimovel' => ['Código Imóvel' => $dados['codigoimovel']],
            'finalidade' => ['Finaliade' => $dados['finalidade']],
            'midia' => ['Midia' => $dados['midia']],
            'campanha' => ['Campanha' => $dados['campanha']],
            'utm' => ['UTM' => $dados['utm']],
        ];

        $dados['mensagem'] = Helper::gerarTabelaParaEnvioDeEmail($corpo, $dados['assunto'], IMOBILIARIA);

        $email = new Email();
        // SE A VARIAVEL $configuracoes['email_forma_envio_configuracao'] FOR ( 1 ) ENVIAR O E-MAIL SEM AUTENTICAÇÃO
        $response = ($configuracoes['email_forma_envio_configuracao'] ? $email->enviarEmailPHPmail($dados) : $email->enviarEmailSmtp($dados));

        header('Content-Type: application/json');
        echo json_encode($response);

    }
}
