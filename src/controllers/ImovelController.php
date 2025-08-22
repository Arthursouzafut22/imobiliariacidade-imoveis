<?php

namespace src\controllers;

use \core\Controller;
use src\handlers\Helper;
use \src\handlers\UrlEncode;
use \src\handlers\Imovel;
use \src\handlers\Tipo;
use \src\handlers\Cidade;
use \src\handlers\Email;
use \src\handlers\Bairro;
use \src\handlers\SeoBusca;
use \src\handlers\ToggleQueriesData;
use src\models\CmsPagina;

use src\models\CmsConfiguracao;
use src\models\CmsPaginaConteudoImagem;
use src\models\CmsScriptsExternos;
use src\models\Imob_bairro;
use src\models\Imob_caracteristica_extra;
use src\models\Imob_cidade;
use src\models\Imob_condominio;
use src\models\Imob_imovel;
use src\models\Imob_imovel_caracteristica_extra;
use src\models\Imob_tipoimovel;
use \src\handlers\Video;
use \src\handlers\CheckUrl;
use src\handlers\Lead;
use src\models\ImobBairro;
use src\models\LeadDAO;

class ImovelController extends Controller
{
    public function __construct()
    {
        $conf = CmsConfiguracao::first()->toArray();
        Helper::siteEmManutencao($conf);
    }

    //RETORNA OS PARAMETROS DA BUSCA FORMATO JSON
    public function getParametrosGerais()
    {
        $dados = [];

        $url = new UrlEncode();
        $tipoDAO = new Imob_tipoimovel();
        $tipos = $tipoDAO->retornarTiposImoveisDisponiveis();


        foreach ($tipos['lista'] as $key => $t) {
            $tipos['lista'][$key]['url_amigavel'] = $url->amigavelURL($t['nome']);
        }

        $cidadeDAO = new Imob_cidade();
        $cidade = $cidadeDAO->retornarCidadeDisponiveis();

        foreach ($cidade['lista'] as $key => $value) {
            $cidade['lista'][$key]['nomeUrl'] = $value['nomeurlamigavel'];
            $cidade['lista'][$key]['estadoUrl'] = $url->amigavelURL($value['estado']);
        }

        $bairroDAO = new ImobBairro();
        $bairros['lista'] = $bairroDAO->select([
            'imob_cidade.nome as nomecidade',
            'imob_cidade.nome as cidade',
            'imob_bairro.nome as nomebairro',
            'imob_bairro.codigo as codigobairro',
            'imob_cidade.estado',
        ])
            ->join('imob_cidade', 'imob_bairro.codigocidade', '=', 'imob_cidade.codigo')
            ->orderBy('nomebairro', 'asc')
            ->get()->toArray();


        foreach ($bairros['lista'] as $key => $value) {
            $bairros['lista'][$key]['cidadeUrl'] = $url->amigavelURL($value['nomecidade']);
            $bairros['lista'][$key]['nome'] = $value['nomebairro'];
            $bairros['lista'][$key]['codigo'] = $value['codigobairro'];
            $bairros['lista'][$key]['nomeUrl'] = $url->amigavelURL($value['nomebairro']);
            $bairros['lista'][$key]['estadoUrl'] = $url->amigavelURL($value['estado']);
        }

        $imovelCond = new imovel();
        $imovelCond->setNumeroregistros(1000);
        $imovelCond->setRetornoReduzido(true);
        $imovelCond->setFinalidade(0);

        $condDAO = new Imob_condominio();
        $cond = $condDAO->retornarCondominiosDisponiveis();

        foreach ($cond['lista'] as $key => $value) {
            $cond['lista'][$key]['nomeUrl'] = $url->amigavelURL($value['nome']);
        }

        $dados['tipos'] = $tipos['lista'];
        $dados['cidades'] = $cidade['lista'];
        $dados['bairros'] = $bairros['lista'];
        $dados['condominios'] = $cond['lista'];

        header('Content-Type: application/json');
        echo json_encode($dados);
    }

    public function getParametrosURL()
    {

        if (!empty($_SESSION['paramentrosURL']) && isset($_SESSION['paramentrosURL'])) {

            header('Content-Type: application/json');
            echo json_encode($_SESSION['paramentrosURL']);
        } else {

            $_SESSION['paramentrosURL'] = array();

            header('Content-Type: application/json');
            echo json_encode($_SESSION['paramentrosURL']);
        }
    }

    public function index($params)
    {
        $dados = [];

        $url = new UrlEncode();
        $url->prepararUrlApi($params);
        $titulo = $url->gerarTituloPagina();

        //$titulo = Helper::plural($titulo);

        // var_dump($titulo);
        // exit();

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
        $dados['cms_pagina']['meta_titulo_pagina'] = $titulo;

        //configuracoes
        $dados['configuracoes']['ocultar_footer'] = true;

        $check = new CheckUrl();

        if (!isset($_SESSION[SESSION_UNIC]) || empty($_SESSION[SESSION_UNIC])) {
            $check->getParametrosGeraisCheck();
        }

        if ($check->checkURL($params)) {
            $dados['configuracoes'] = CmsConfiguracao::first()->toArray();
            $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
                ->where('cod_pagina_conteudo', 45)
                ->orderBy('ordem_imagem_conteudo', 'asc')
                ->get()
                ->toArray();

            $dados['configuracoes']['ocultar_footer'] = true;
            $dados['script'] = CmsScriptsExternos::first()->toArray();
            $dados['configuracoes']['ocultar_footer'] = false;

            header("HTTP/1.1 410 Gone");
            $this->render('404', $dados);
            exit;
        }


        //GRAVA NA SESSAO O VALOR DIGITADO NA URL
        $valor_min = 0;
        $valor_max = 0;
        $area_min = 0;
        $area_max = 0;

        if (!empty($_GET['valor_min']) && isset($_GET['valor_min'])) {
            $valor_min = $_GET['valor_min'];
        }
        if (!empty($_GET['valor_max']) && isset($_GET['valor_max'])) {
            $valor_max = $_GET['valor_max'];
        }
        if (!empty($_GET['area_min']) && isset($_GET['area_min'])) {
            $area_min = $_GET['area_min'];
        }
        if (!empty($_GET['area_max']) && isset($_GET['area_max'])) {
            $area_max = $_GET['area_max'];
        }

        if (isset($_GET['ordenacao']) &&  !empty($_GET['ordenacao'])) {
            $dados['ordenacao'] = $_GET['ordenacao'];
        } else {
            $dados['ordenacao'] = '';
        }


        //SALVA PARAMETROS DA URL
        $_SESSION['paramentrosURL'] = $url->parametrosURL;
        $_SESSION['paramentrosURL']['area'] = [$area_min, $area_max];
        $_SESSION['paramentrosURL']['valor'] = [$valor_min, $valor_max];

        $dados['breadcrumb'] = $url->breadcrumb;
        $dados['tituloPagina'] = $titulo;

        $seo = new SeoBusca();
        $dados['title'] = $seo->getTitulo($url->breadcrumb);

        //TRATAMENTO DA TAG CANONICAL
        $dados['canonical'] = '<link rel="canonical" href="' . BASE_URL .
            (isset($_SESSION['paramentrosURL']['finalidade'][0]) ? $_SESSION['paramentrosURL']['finalidade'][0] . '/' : '') .
            (isset($_SESSION['paramentrosURL']['tipos'][0]) ? $_SESSION['paramentrosURL']['tipos'][0] . '/' : '') .
            (isset($_SESSION['paramentrosURL']['cidades'][0]) ? $_SESSION['paramentrosURL']['cidades'][0] . '/' : '') .
            (isset($_SESSION['paramentrosURL']['bairros'][0]) ? $_SESSION['paramentrosURL']['bairros'][0] : '') . '" />';

        $dados['description'] = $seo->getDescription($url->breadcrumb);
        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();
        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 45)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();
        $dados['configuracoes']['ocultar_footer'] = true;

        $dados['cms_pagina']['favicon'] = $dados['configuracoes']['favicon'];


        $dados['script'] = CmsScriptsExternos::first()->toArray();

        $this->render('listagem-imoveis', $dados);
    }

    public function retornarImoveisDisponiveis()
    {
        $response = [];
        $dados = $this->getRequestData();

        if (!isset($dados['tipos'])) {
            $dados['tipos'] = [];
        }

        if (!isset($dados['bairros'])) {
            $dados['bairros'] = [];
        }

        if (!isset($dados['extras'])) {
            $dados['extras'] = [];
        }

        $imovel = new Imovel();
        $imovel->setFinalidade($dados['finalidade']);
        $imovel->setCodigoTipo($dados['tipos']);
        $imovel->setCodigocidade($dados['codigocidade']);
        $imovel->setCodigosbairros($dados['bairros']);
        $imovel->setEndereco($dados['endereco']);
        $imovel->setNumerobanhos($dados['numerobanhos']);
        $imovel->setNumeroquartos($dados['numeroquartos']);
        $imovel->setNumerovagas($dados['numerovagas']);
        $imovel->setNumerosuite($dados['numerosuite']);
        $imovel->setValorde($dados['valorde']);
        $imovel->setValorate($dados['valorate']);
        $imovel->setAreade($dados['areade']);
        $imovel->setAreaate($dados['areaate']);
        $imovel->setNumeropagina($dados['numeropagina']);
        $imovel->setNumeroregistros($dados['numeroregistros']);
        $imovel->setOrdenacao($dados['ordenacao']);
        $imovel->setCaracteristicas($dados);
        $imovel->setExtras($dados['extras']);
        $imovel->setCodigocondominio($dados['codigocondominio']);
        $imovel->setOpcaoimovel($dados['codigoOpcaoimovel']);
        $imovel->setCodigoEmpreendimentoMae($dados['codigoempreendimentomae']);


        $imo_model = new Imob_imovel();
        //OTIMIZAÇÃO DE CONSULTA NO BANCO DE DADOS
        $imoveis = $imo_model->retornarImoveisDisponiveis($imovel);


        // $imo_model = new Imob_Imovel_api();
        // $imoveis = $imo_model->retornarImoveisDisponiveis($imovel);

        if (isset($imoveis['lista'][0]['total_registros'])) {

            $imoveis['quantidade'] = $imoveis['lista'][0]['total_registros'];
        } else {
            $imoveis['quantidade'] = 0;
        }

        $arr = [];
        $url = new UrlEncode();

        foreach ($imoveis['lista'] as $key => $i) {
            $imoveis['lista'][$key]['tempoCadastro'] = $imovel->imovelNovo($i['datahoracadastro']);
            $imoveis['lista'][$key]['titulo'] = Helper::gerarTituloImovel($i);
            $imoveis['lista'][$key]['url_amigavel'] = $url->amigavelURL($imoveis['lista'][$key]['titulo']);
            $imoveis['lista'][$key]['fotos'] = json_decode($i['fotos']);
            $imoveis['lista'][$key]['fotos360'] = json_decode($i['fotos360']);
            $imoveis['lista'][$key]['captadores'] = json_decode($i['captadores']);

            $imoveis['lista'][$key]['areainterna'] = Helper::tratarValoresEmpreendimentos($i['areainterna']);
            $imoveis['lista'][$key]['numeroquartos'] = Helper::tratarValoresEmpreendimentos($i['numeroquartos']);
            $imoveis['lista'][$key]['numerobanhos'] = Helper::tratarValoresEmpreendimentos($i['numerobanhos']);
            $imoveis['lista'][$key]['numerovagas'] = Helper::tratarValoresEmpreendimentos($i['numerovagas']);
        }

        $imoveis['favoritos'] = '';

        if (!empty($_SESSION['favoritos'])) {
            $imoveis['favoritos'] = $_SESSION['favoritos'];
        } else {
            $imoveis['favoritos'] = array();
        }


        header('Content-Type: application/json');
        echo json_encode($imoveis);
    }

    public function retornarImoveisDisponiveisMapa()
    {

        $dados = $this->getRequestData();

        if (!isset($dados['tipos'])) {
            $dados['tipos'][0]['codigo'] = '';
        }

        if (!isset($dados['bairros'])) {
            $dados['bairros'][0]['codigo'] = '';
        }

        $imovel = new Imovel();
        $imovel->setFinalidade($dados['finalidade']);
        $imovel->setCodigoTipo($dados['tipos']);
        $imovel->setCodigocidade($dados['codigocidade']);
        $imovel->setCodigosbairros($dados['bairros']);
        $imovel->setEndereco($dados['endereco']);
        $imovel->setNumerobanhos($dados['numerobanhos']);
        $imovel->setNumeroquartos($dados['numeroquartos']);
        $imovel->setNumerovagas($dados['numerovagas']);
        $imovel->setNumerosuite($dados['numerosuite']);
        $imovel->setValorde($dados['valorde']);
        $imovel->setValorate($dados['valorate']);
        $imovel->setAreade($dados['areade']);
        $imovel->setAreaate($dados['areaate']);
        $imovel->setNumeropagina($dados['numeropagina']);
        $imovel->setNumeroregistros($dados['numeroregistros']);
        $imovel->setCaracteristicas($dados);
        $imovel->setRetornomapaapp(true);
        $imovel->setOpcaoimovel($dados['codigoOpcaoimovel']);

        $imo_model = new Imob_imovel();
        $imoveis = $imo_model->retornarImoveisDisponiveis($imovel);

        header('Content-Type: application/json');
        echo json_encode($imoveis);
    }

    public function retornarImovelCodigo()
    {

        $dados = $this->getRequestData();

        $imovel = new Imovel();
        $imovel->setCodigosimoveis($dados['codigo']);
        $imovel->setFinalidade('');
        $imovel->setNumeropagina($dados['pagina']);
        $imovel->setOpcaoimovel(0);

        $imo_model = new Imob_imovel();

        // if (BUSCAR_CODIGO_MAPA_MYSQL) {
        //     $imoveis = ToggleQueriesData::retornarImoveisDiponiveis($imo_model, $dados);
        // } else {
        $imoveis = $imo_model->getImovelPorCodigo($imovel);
        // }

        if (isset($imoveis['lista'][0]['total_registros'])) {

            $imoveis['quantidade'] = $imoveis['lista'][0]['total_registros'];
        } else {
            $imoveis['quantidade'] = 0;
        }


        $url = new UrlEncode();
        foreach ($imoveis['lista'] as $key => $i) {

            $imoveis['lista'][$key]['tempoCadastro'] = $imovel->imovelNovo($i['datahoracadastro']);
            $imoveis['lista'][$key]['titulo'] = Helper::gerarTituloImovel($i);
            $imoveis['lista'][$key]['url_amigavel'] = $url->amigavelURL($imoveis['lista'][$key]['titulo']);
            $imoveis['lista'][$key]['fotos'] = json_decode($i['fotos']);
            $imoveis['lista'][$key]['fotos360'] = json_decode($i['fotos360']);
            $imoveis['lista'][$key]['captadores'] = json_decode($i['captadores']);
        }

        $imoveis['favoritos'] = array();

        if (!empty($_SESSION['favoritos'])) {
            $imoveis['favoritos'] = $_SESSION['favoritos'];
        } else {
            $imoveis['favoritos'] = array();
        }

        header('Content-Type: application/json');
        echo json_encode($imoveis);
    }


    public function retornarImoveisEmpreendimentosFilhosDisponiveis()
    {

        $dados = $this->getRequestData();

        $imovel = new Imovel();
        $imovel->setCodigosimoveis($dados['codigo']);
        $imovel->setFinalidade('');
        $imovel->setNumeropagina($dados['pagina']);
        $imovel->setOpcaoimovel(0);

        $imo_model = new Imob_imovel();
        $imoveis = $imo_model->retornarImoveisEmpreendimentosFilhosDisponiveis($imovel);

        if (isset($imoveis['lista'][0]['total_registros'])) {

            $imoveis['quantidade'] = $imoveis['lista'][0]['total_registros'];
        } else {
            $imoveis['quantidade'] = 0;
        }

        $url = new UrlEncode();
        foreach ($imoveis['lista'] as $key => $i) {

            $imoveis['lista'][$key]['tempoCadastro'] = $imovel->imovelNovo($i['datahoracadastro']);
            $imoveis['lista'][$key]['titulo'] = Helper::gerarTituloImovel($i);
            $imoveis['lista'][$key]['url_amigavel'] = $url->amigavelURL($imoveis['lista'][$key]['titulo']);
            $imoveis['lista'][$key]['fotos'] = json_decode($i['fotos']);
            $imoveis['lista'][$key]['fotos360'] = json_decode($i['fotos360']);
            $imoveis['lista'][$key]['captadores'] = json_decode($i['captadores']);
        }

        $imoveis['favoritos'] = array();

        if (!empty($_SESSION['favoritos'])) {
            $imoveis['favoritos'] = $_SESSION['favoritos'];
        } else {
            $imoveis['favoritos'] = array();
        }

        header('Content-Type: application/json');
        echo json_encode($imoveis);
    }



    public function imovelDetalhesDados()
    {

        if (!empty($_SESSION['favoritos'])) {

            $_SESSION['detalhe-imovel']->favoritos = $_SESSION['favoritos'];
        } else {

            $_SESSION['detalhe-imovel']->favoritos = array();
        }

        header('Content-Type: application/json');
        echo json_encode($_SESSION['detalhe-imovel']);
    }

    public function detalhe($params)
    {

        $imo = new Imovel();
        $imo->setCodigosimoveis($params['id']);
        $imoDao = new Imob_imovel();
        $retorno = $imoDao->getImovelPorCodigo($imo)['lista'];

        if ($retorno == null) {

            $dados['configuracoes'] = CmsConfiguracao::select([
                'logo',
                'logo_monocromatica',
                'favicon',
                'nome_imobiliaria',
                'creci',
                'tel_fixo',
                'tel_fixo_venda',
                'tel_fixo_aluguel',
                'tel_celular',
                'tel_cel_venda',
                'tel_cel_aluguel',
                'endereco',
                'txt_footer',
                'blog',
                'captcha_ativo',
                'email'
            ])->first()->toArray();

            $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
                ->where('cod_pagina_conteudo', 45)
                ->orderBy('ordem_imagem_conteudo', 'asc')
                ->get()
                ->toArray();

            $dados['script'] = CmsScriptsExternos::first()->toArray();

            //pego os dados da pagina
            $dados['cms_pagina'] = CmsPagina::select("*")
                ->where('cod_pagina', 30) // 30 = Pagina nao encontrada 404
                ->first()
                ->toArray();

            header("HTTP/1.1 410 Gone");
            $this->render('404', $dados);
            exit;
        }

        $retorno = $retorno[0];

        //DEFINIR TAG OTIMO PREÇO / NOVO
        $retorno['tempoCadastro'] = $imo->imovelNovo($retorno['datahoracadastro']);


        $url = new UrlEncode();
        $retorno['fotos'] = json_decode($retorno['fotos']);
        $retorno['fotos360'] = json_decode($retorno['fotos360']);
        $retorno['captadores'] = json_decode($retorno['captadores']);
        $retorno['url_condominio'] = (isset($retorno['nomecondominio']) ? $url->amigavelURL($retorno['nomecondominio']) : '');
        $retorno['url_cidade'] = $url->amigavelURL($retorno['cidade']);
        $retorno['url_bairro'] = $url->amigavelURL($retorno['bairro']);
        $retorno['url_tipo'] = $url->amigavelURL($retorno['tipo']);
        $retorno['nomecondominio'] = (isset($retorno['nomecondominio']) ? $retorno['nomecondominio'] : '');
        $retorno['titulo'] = Helper::gerarTituloImovel($retorno);

        $retorno['areaprincipal'] = Helper::tratarValoresEmpreendimentos($retorno['areaprincipal']);
        $retorno['arealote'] = Helper::tratarValoresEmpreendimentos($retorno['arealote']);
        $retorno['numeroquartos'] = Helper::tratarValoresEmpreendimentos($retorno['numeroquartos']);
        $retorno['numerobanhos'] = Helper::tratarValoresEmpreendimentos($retorno['numerobanhos']);
        $retorno['numerovagas'] = Helper::tratarValoresEmpreendimentos($retorno['numerovagas']);
        $retorno['numerosuites'] = Helper::tratarValoresEmpreendimentos($retorno['numerosuites']);

        $retorno['valor'] = Helper::tratarValoresEmpreendimentos($retorno['valor']);

        // $retorno['configuracoes'] = CmsConfiguracao::first()->toArray();



        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 45)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();

        $retorno['script'] = CmsScriptsExternos::first()->toArray();

        //pego os dados da pagina
        $retorno['cms_pagina'] = CmsPagina::select("*")
            ->where('cod_pagina', 13) // 13 = detalhes imovel
            ->first()
            ->toArray();

        $retorno['cms_pagina']['titulo_pagina'] = $retorno['titulo'];
        $retorno['cms_pagina']['meta_titulo_pagina'] = $retorno['titulo'];
        $retorno['cms_pagina']['meta_descricao_pagina'] = $retorno['metadescription'];
        $retorno['cms_pagina']['imagem_og'] = $retorno['urlfotoprincipalpp'];
        $retorno['cms_pagina']['favicon'] = $retorno['configuracoes']['favicon'] = CmsConfiguracao::pluck('favicon')->first();


        $retorno['valorcondominio'] = 'R$ ' . number_format($retorno['valorcondominio'], 2, ',', '.');
        $retorno['valoriptu'] = 'R$ ' . number_format($retorno['valoriptu'], 2, ',', '.');
        $retorno['valormaiscondominiomaisiptu'] = 'R$ ' . number_format($retorno['valormaiscondominiomaisiptu'], 2, ',', '.');

        if ($retorno['urlvideo'] != '') {
            $v = new Video();
            $retorno['urlvideo'] = $v->tratarVideo($retorno['urlvideo']);
        }

        $helper = new Helper();
        $retorno['tag'] = $helper->retornarTagDetalheImovel($retorno);

        $retorno['configuracoes'] = CmsConfiguracao::select([
            'logo',
            'logo_monocromatica',
            'favicon',
            'nome_imobiliaria',
            'creci',
            'tel_fixo',
            'tel_fixo_venda',
            'tel_fixo_aluguel',
            'tel_celular',
            'tel_cel_venda',
            'tel_cel_aluguel',
            'endereco',
            'txt_footer',
            'blog',
            'captcha_ativo',
            'email'
        ])->first()->toArray();

        // $retorno['configuracoes'] = CmsConfiguracao::first()->toArray();


        $retorno['configuracoes']['mensagem_whatsapp_custom'] = "Olá, gostaria de mais informações sobre o imóvel: " . $params['id'] . ".";



        //Mensagem do WhatsApp
        $retorno['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 45)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();

        //$retorno['extras2'] = Imob_imovel_caracteristica_extra::where('codigoimovel', '=', $params['id'])->distinct()->get()->toArray();


        $retorno['extras2'] = Imob_imovel_caracteristica_extra::select([
            'imob_imovel_caracteristica_extra.codigoimovel as codigoimovel',
            'imob_imovel_caracteristica_extra.codigocaracteristicaextra as codigocaracteristicaextra',
            'imob_caracteristica_extra.nome as nome',
            'imob_caracteristica_extra.nomeurlamigavel as nomeurlamigavel'
        ])
            ->where('codigoimovel', '=', $params['id'])
            ->join('imob_caracteristica_extra', 'imob_caracteristica_extra.codigo', '=', 'imob_imovel_caracteristica_extra.codigocaracteristicaextra')
            ->orderBy('nome', 'asc')
            ->get()->toArray();



        $retorno = (object) $retorno;
        $_SESSION['detalhe-imovel'] = $retorno;


        //VERIFICA SE IMÓVEL ESTÁ FAVORITADO
        $retorno->favoritos = array();
        if (!empty($_SESSION['favoritos'])) {
            $retorno->favoritos = $_SESSION['favoritos'];
        } else {
            $retorno->favoritos = array();
        }

        $retorno->estaFavoritado = false;

        foreach ($retorno->favoritos as $key => $favorito) {
            if ($favorito == $retorno->codigo) {
                $retorno->estaFavoritado = true;
            }
        }

        $this->render('detalhe-imovel', ['imovel' => $retorno]);
    }
    public function detalheSitesExternos($params)
    {

        $imo = new Imovel();
        $imo->setCodigosimoveis($params['id']);
        $imoDao = new Imob_imovel();
        $retorno = $imoDao->getImovelPorCodigo($imo)['lista'];
        $url = new UrlEncode();
        $tituloAmigavel = $url->amigavelURL($retorno[0]['titulo']);

        // echo '<pre>';
        // var_dump($tituloAmigavel);
        // exit;

        $urmAmigavel = BASE_URL . 'imovel/' . $tituloAmigavel . '/' . $params['id'];

        // Redirecionamento permanente (301)
        return header("Location: ". $urmAmigavel, true, 301);
    }

    public function retornarImoveisDestaques()
    {

        $response = [];
        $dados = $this->getRequestData();

        if (!isset($dados['tipos'])) {
            $dados['tipos'][0]['codigo'] = '';
        }

        if (!isset($dados['bairros'])) {
            $dados['bairros'][0]['codigo'] = '';
        }

        $imovel = new Imovel();
        $imovel->setFinalidade($dados['finalidade']);
        $imovel->setCodigoTipo($dados['tipos']);
        $imovel->setCodigocidade($dados['codigocidade']);
        $imovel->setCodigosbairros($dados['bairros']);
        $imovel->setEndereco($dados['endereco']);
        $imovel->setNumerobanhos($dados['numerobanhos']);
        $imovel->setNumeroquartos($dados['numeroquartos']);
        $imovel->setNumerovagas($dados['numerovagas']);
        $imovel->setNumerosuite($dados['numerosuite']);
        $imovel->setValorde($dados['valorde']);
        $imovel->setValorate($dados['valorate']);
        $imovel->setAreade($dados['areade']);
        $imovel->setAreaate($dados['areaate']);
        $imovel->setNumeropagina($dados['numeropagina']);
        $imovel->setNumeroregistros($dados['numeroregistros']);
        $imovel->setOrdenacao($dados['ordenacao']);
        $imovel->setCaracteristicas($dados);
        $imovel->setCodigocondominio($dados['codigocondominio']);
        $imovel->setDestaque($dados['destaque']);

        $imo_model = new Imob_imovel();

        //OTIMIZAÇÃO DE CONSULTA NO BANCO DE DADOS
        $imoveis = $imo_model->retornarImoveisDestaque($imovel);

        if (isset($imoveis['lista'][0]['total_registros'])) {

            $imoveis['quantidade'] = $imoveis['lista'][0]['total_registros'];
        } else {
            $imoveis['quantidade'] = 0;
        }

        $arr = [];
        $url = new UrlEncode();

        foreach ($imoveis['lista'] as $key => $i) {

            $imoveis['lista'][$key]['tempoCadastro'] = $imovel->imovelNovo($i['datahoracadastro']);
            $imoveis['lista'][$key]['titulo'] = Helper::gerarTituloImovel($i);
            $imoveis['lista'][$key]['url_amigavel'] = $url->amigavelURL($imoveis['lista'][$key]['titulo']);
            $imoveis['lista'][$key]['fotos'] = json_decode($i['fotos']);
            $imoveis['lista'][$key]['fotos360'] = json_decode($i['fotos360']);
            $imoveis['lista'][$key]['captadores'] = json_decode($i['captadores']);
        }

        $imoveis['favoritos'] = '';

        if (!empty($_SESSION['favoritos'])) {
            $imoveis['favoritos'] = $_SESSION['favoritos'];
        } else {
            $imoveis['favoritos'] = array();
        }

        header('Content-Type: application/json');
        echo json_encode($imoveis);
    }

    public function retornarImoveisLancamento()
    {

        $imovel = new Imovel();
        $imovel->setFinalidade('venda');
        $imovel->setNumeropagina(1);
        $imovel->setNumeroregistros(20);
        $imovel->setOpcaoimovel(4);

        $imo_model = new Imob_imovel();
        $imoveis = $imo_model->retornarImoveisDisponiveis($imovel);

        if (count($imoveis['lista']) > 0) {
            foreach ($imoveis['lista'] as $key => $i) {
                $imoveis['lista'][$key]->tempoCadastro = $imovel->imovelNovo($i->datahoracadastro);
                $imoveis['lista'][$key]->titulo = Helper::gerarTituloImovel($i);
                $imoveis['lista'][$key]->url_amigavel = $i->amigavelURL($imoveis['lista'][$key]->titulo);
                //$imoveis->lista[$key]->valor = explode(',',$imoveis->lista[$key]->valor)[0];
            }
        }

        $imoveis['favoritos'] = array();

        if (!empty($_SESSION['favoritos'])) {
            $imoveis['favoritos'] = $_SESSION['favoritos'];
        } else {
            $imoveis['favoritos'] = array();
        }

        header('Content-Type: application/json');
        echo json_encode($imoveis);
    }

    public function retornarImoveisSimilares()
    {

        $imo = $_POST;
        $url = new UrlEncode();

        $imovel = new Imovel();
        $imovel->setFinalidade($imo['codigofinalidade']);
        $imovel->setCodigoTipo(['0' => ['codigo' => $imo['codigotipo']]]);
        $imovel->setCodigocidade($imo['codigocidade']);
        $imovel->setNumeropagina(1);
        $imovel->setNumeroregistros(20);
        $imovel->setOpcaoimovel(0);
        $imovel->setExtras([]);

        $imo_model = new Imob_imovel();

        //OTIMIZAÇÃO DE CONSULTA NO BANCO DE DADOS
        $imoveis = $imo_model->retornarImoveisDisponiveis($imovel);


        foreach ($imoveis['lista'] as $key => $i) {
            $imoveis['lista'][$key]['tempoCadastro'] = $imovel->imovelNovo($i['datahoracadastro']);
            $imoveis['lista'][$key]['titulo'] = Helper::gerarTituloImovel($i);
            $imoveis['lista'][$key]['url_amigavel'] = $url->amigavelURL($imoveis['lista'][$key]['titulo']);
            $imoveis['lista'][$key]['fotos'] = json_decode($i['fotos']);
            $imoveis['lista'][$key]['fotos360'] = json_decode($i['fotos360']);
            $imoveis['lista'][$key]['captadores'] = json_decode($i['captadores']);
        }

        $imoveis['favoritos'] = array();

        if (!empty($_SESSION['favoritos'])) {

            $imoveis['favoritos'] = $_SESSION['favoritos'];
        } else {

            $imoveis['favoritos'] = array();
        }


        header('Content-Type: application/json');
        echo json_encode($imoveis);
    }
    public function naoAchouImovel()
    {
        $configuracoes = CmsConfiguracao::first()->toArray();

        $dados = $this->getRequestData();

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
        $dados['anotacoes'] = 'CLIENTE NÃO ENCONTROU O IMÓVEL QUE DESEJA - (CTA - 2) página de detalhe';
        $dados['utm'] = isset($_COOKIE['utm_source']) ? $_COOKIE['utm_source'] : 'site';

        $leadDao = new LeadDAO(new Lead());
        $lead = $leadDao->incluirLead($dados);

        $dados['destinatario'] = $configuracoes['email_destinatario_configuracao'];
        $dados['assunto'] = $configuracoes['nome_imobiliaria'] . " - Imóvel Ideal - Detalhe do imóvel";
        $dados['emailresposta'] = $configuracoes['email_resposta_configuracao'];
        $dados['nomeresposta'] = $configuracoes['nome_imobiliaria'];
        $dados['email_remetente_configuracao'] = $configuracoes['email_remetente_configuracao'];
        $dados['email_remetente_senha_configuracao'] = $configuracoes['email_remetente_senha_configuracao'];
        $dados['email_remetente_smtp_configuracao'] = $configuracoes['email_remetente_smtp_configuracao'];
        $dados['email_remetente_porta_configuracao'] = $configuracoes['email_remetente_porta_configuracao'];
        $dados['email_resposta'] = $configuracoes['email_resposta_configuracao'];

        $corpo = [
            'nome' => ['Nome' => $dados['nome']],
            'email' => ['E-mail' => $dados['email']],
            'tel' => ['Telefone' => $dados['tel']],
            'anotacoes' => ['Anotações' => $dados['anotacoes']],
            'midia' => ['Mídia' => (isset($_COOKIE['midia_origem']) ? $_COOKIE['midia_origem'] : 'site')],
            'campanha' => ['Campanha' => (isset($_COOKIE['utm_campaign']) ? $_COOKIE['utm_campaign'] : 'site')],
            'utm' => ['Utm' => (isset($_COOKIE['utm_source']) ? $_COOKIE['utm_source'] : 'site')],
        ];

        $dados['mensagem'] = Helper::gerarTabelaParaEnvioDeEmail($corpo, $dados['assunto'], IMOBILIARIA);

        $email = new Email();
        // SE A VARIAVEL $configuracoes['email_forma_envio_configuracao'] FOR ( 1 ) ENVIAR O E-MAIL SEM AUTENTICAÇÃO
        $response = ($configuracoes['email_forma_envio_configuracao'] ? $email->enviarEmailPHPmail($dados) : $email->enviarEmailSmtp($dados));


        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function imovelNaoEncontrado()
    {
        $dados = [];

        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();
        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 45)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();

        $this->render('imovel-nao-encontrado', $dados);
    }
}
