<?php

namespace src\controllers;

use \core\Controller;
use src\handlers\Helper;
use src\models\CmsConfiguracao;
use src\models\CmsPagina;
use src\models\CmsPaginaConteudo;
use src\models\CmsPaginaConteudoImagem;
use src\models\CmsPaginaConteudoPerguntaResposta;
use src\models\CmsScriptsExternos;
use src\models\CaptacaoPage;

use src\models\Captacao;

use \src\handlers\Email;

class AnuncieImovelController extends Controller
{
    public function __construct()
    {
       

        $conf = CmsConfiguracao::first()->toArray();
        Helper::siteEmManutencao($conf);
    }

    public function index()
    {
        $COD_PAGINA = 6; // CPODIGO DA PAGINA CAPTAÇÃO

        $dados = [];

        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();
        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 45)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();

        $dados['script'] = CmsScriptsExternos::first()->toArray();

        $dados['cms_pagina'] = CmsPagina::select("*")
            ->where('cms_pagina.cod_pagina', $COD_PAGINA)
            ->join('cms_pagina_conteudo', 'cms_pagina.cod_pagina', 'cms_pagina_conteudo.cod_pagina')
            ->first()
            ->toArray();

        $dados['banner'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 65)
            ->first()
            ->toArray();

        $dados['texto_lateral'] = CmsPaginaConteudoPerguntaResposta::select("*")
            ->where('cod_pagina_conteudo', 27)
            ->get()
            ->toArray();

        $dados['beneficios_titulos'] = CmsPaginaConteudo::select("*")
            ->where('cod_pagina_conteudo', 25)
            ->first()
            ->toArray();

        $dados['beneficios'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 25)
            ->get()
            ->toArray();

        $dados['cms_pagina']['favicon'] = $dados['configuracoes']['favicon'];


        $this->render('anunciar-imoveis', $dados);
    }

    private function formatarNumero($param)
    {

        $resposne = '';
        $resposne = str_replace('.', '', $param);
        $resposne = str_replace(',', '.', $resposne);

        return (float) $resposne;
    }

    public function enviarCaptacao()
    {
        $param = $_POST;

        $configuracoes = CmsConfiguracao::first()->toArray();
        $formulario = CmsPaginaConteudo::select("*")
            ->where('cod_pagina_conteudo', 123)
            ->first()
            ->toArray();

        if ($configuracoes['captcha_ativo']) {
            $reposta_capcha = Helper::validarCaptcha($param['g_recaptcha'], $configuracoes['captcha_secret_key']);
            if ($reposta_capcha[0] == false) {
                header('Content-Type: application/json');
                echo json_encode(['mensagem' => $reposta_capcha[1], 'status' => false]);
                exit;
            }
        }

        if (isset($param['g_recaptcha']) && !empty($param['g_recaptcha'])) {
            //remover informação da chave
            unset($param['g_recaptcha']);
        }

        $param['codigounidade'] = CODIGO_UNIDADE;
        $param['valorimovel'] = $this->formatarNumero($param['valorimovel']);
        $param['valorcondominio'] = $this->formatarNumero($param['valorcondominio']);
        $param['valoriptu'] = $this->formatarNumero($param['valoriptu']);
        $param['midia'] = isset($_COOKIE['midia_origem']) ? $_COOKIE['midia_origem'] : 'site';
        $param['campanha'] = isset($_COOKIE['utm_campaign']) ? $_COOKIE['utm_campaign'] : 'site';
        $param['utm'] = isset($_COOKIE['utm_source']) ? $_COOKIE['utm_source'] : 'site';
        $param['anotacoes'] = 'Página Anuncie seu imóvel';
        $param['assunto'] = $configuracoes['nome_imobiliaria'] . " - Anuncie seu imóvel";

        if (TEM_MODULO_CAPTACAO == 1) {
            $leadDao = new CaptacaoPage();
            $lead = $leadDao->incluirLead($param);
        }

        $param['email_remetente_configuracao'] = $configuracoes['email_remetente_configuracao'];
        $param['email_remetente_porta_configuracao'] = $configuracoes['email_remetente_porta_configuracao'];
        $param['email_remetente_smtp_configuracao'] = $configuracoes['email_remetente_smtp_configuracao'];
        $param['email_remetente_senha_configuracao'] = $configuracoes['email_remetente_senha_configuracao'];

        $param['destinatario'] = $formulario['form_email_destinatario'];
        $param['emailresposta'] = $configuracoes['email_resposta_configuracao'];
        $param['emailCopiaOculta'] = $formulario['form_email_destinatario_copia_oculta'];
        $param['nomeresposta'] = $configuracoes['nome_imobiliaria'];

        $finalidade = $param['finalidade'] == 1 ? 'Alugar' : ($param['finalidade'] == 2 ? 'Vender' : $param['finalidade']);

        $corpo = [
            'nome' => ['Nome' => $param['nome']],
            'telefone' => ['Telefone' => $param['telefone']],
            'email' => ['E-mail' => $param['email']],
            'finalidade' => ['Finalidade' => $finalidade],
            'valorimovel' => ['Valor' => $param['valorimovel']],
            'valorcondominio' => ['Valor Condomínio' => $param['valorcondominio']],
            'valoriptu' => ['Valor IPTU' => $param['valoriptu']],
            'areainterna' => ['Área Interna' => $param['areainterna']],
            'areaexterna' => ['Área Externa' => $param['areaexterna']],
            'arealote' => ['Área do Lote' => $param['arealote']],
            'andar' => ['Andar' => $param['andar']],
            'numeroquarto' => ['Quantidade de Quartos' => $param['numeroquarto']],
            'numerosuite' => ['Quantidade de Suítes' => $param['numerosuite']],
            'numerobanho' => ['Quantidade de Banheiros' => $param['numerobanho']],
            'numerovaga' => ['Quantidade de Vagas' => $param['numerovaga']],
            'cep' => ['CEP' => $param['cep']],
            'endereco' => ['Endereço' => $param['endereco']],
            'numeroendereco' => ['Número' => $param['numeroendereco']],
            'cidade' => ['Cidade' => $param['cidade']],
            'complemento' => ['Complemento' => $param['complemento']],
            'bairro' => ['Bairro' => $param['bairro']],
            'anotacoes' => ['Anotações' => $param['anotacoes']],
            'midia' => ['Mídia' => $param['midia']],
            'campanha' => ['Campanha' => $param['campanha']],
            'utm' => ['UTM' => $param['utm']],
        ];

        $param['mensagem'] = Helper::gerarTabelaParaEnvioDeEmail($corpo, $param['assunto'], $configuracoes['nome_imobiliaria']);

        // $configuracoes = CmsConfiguracao::first()->toArray();

        $email = new Email();
        // SE A VARIAVEL $configuracoes['email_forma_envio_configuracao'] FOR ( 1 ) ENVIAR O E-MAIL SEM AUTENTICAÇÃO
        $response = ($configuracoes['email_forma_envio_configuracao'] ? $email->enviarEmailPHPmail($param) : $email->enviarEmailSmtp($param));

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function captacaoRedirecionamento()
    {
        header("HTTP/1.1 301 Moved Permanently");
        header('Location:' . BASE_URL . 'anuncie-seu-imovel');
    }
}
