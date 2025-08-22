<?php

namespace src;

use src\handlers\Helper;
use Illuminate\Database\Capsule\Manager as Capsule;

// ATIVAÇÃO DO CHAT
define('CHAT', 0); // 1 para ativado e 0 para desativado
define('ROTA', 'chitolina');
define('MULTIPLOS_WHATSAPP', false);

//codigo da unidade que sera enviado o lead de captacao.
define('CODIGO_UNIDADE', '4381'); //colocar código da unidade principal

//se for ambiente localhost
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {

    $BASE_URL = 'http://' . $_SERVER['HTTP_HOST'] . '/chitolina2025/';
    define('AREA_CLIENTE', 'https://cliente.portalunsoft.com.br/' . ROTA . '');
    define('BASE_URL_CMS', 'http://localhost/cms.sitesuniversal/');
    define('VERSAO', time());
    define('BASE_DADOS', 'chitolina');
    // define('BASE_DADOS', 'premium2025');
}

//Se for producao
else {
    $BASE_URL = 'https://chitolinaimobiliaria.com.br/';
    define('AREA_CLIENTE', 'https://cliente.portalunsoft.com.br/' . ROTA . '');
    define('BASE_URL_CMS', 'https://cms.sitesuniversal.com.br/'); //  não alterar essa linha
    define('VERSAO', '1.7');
    define('BASE_DADOS', 'estilo');
    // define('BASE_DADOS', 'premium2025');
}


// definicao do tema
if (isset($_GET['temasite'])) {
    $_SESSION['temasite'] = $_GET['temasite'];
}

if (isset($_SESSION['temasite'])) {
    define('TEMA',  $_SESSION['temasite']); // 1 = dark | 0 = clean
} else {
    define('TEMA', '0'); // 1 = dark | 0 = clean
}



//valida variavel tema string
if (TEMA == '1') {
    define('TEMA_STRING', 'dark');
} else {
    define('TEMA_STRING', 'clean');
}

$capsule = new Capsule;
$capsule->addConnection([
    "driver" => "mysql",
    "host" => "serverumbler.sitesuniversal.com.br",
    "database" => BASE_DADOS,
    "username" => "root",
    "password" => "9wFC#Jp3MDMrvQAa@",
    "charset" => "utf8"
]);

class Config
{
    const BASE_DIR = '';
    const ERROR_CONTROLLER = 'ErrorController';
    const DEFAULT_ACTION = 'index';
    const URL_API = 'https://api.imoview.com.br/';
}

define('NOME_DEV', 'Arthur Santos');
define('BASE_URL', $BASE_URL);
define('IMAGEM_OG_PADRAO', "https://estiloimobiliaria.com/public/assets/images/logo-link.png");
define('DISPOSITIVO_MOBILE', (new Helper())->verificarMobile());

//MAPA NO SITE
define('APIGOOLGE', '#');
define('MAPA_LISTAGEM_IMOVEL', 0);
define('MAPA_DETALHES_IMOVEL_LOCALIZACAO', 0);
define('MAPA_DETALHES_IMOVEL_RUA', 0);
define('MAPA_ATIVAR_PROXIMIDADES', 0);


// BUSCAS PRONTAS HOME
define('BAIRROS_HOME_BANCO', true); //define se vai puxar os bairros do banco(CMS) ou da função PHP. False = função PHP || True = buscar do banco(CMS)

define('BAIRROS_HOME_VENDA', '1,4,5,16'); // Bairros busca pronta home
define('TIPOS_BAIRROS_HOME_VENDA', '1,2,4,10'); // Tipos de imóveis busca pronta home.

define('BAIRROS_HOME_LOCACAO', '20,21,22,23'); // Bairros busca pronta home
define('TIPOS_BAIRROS_HOME_LOCACAO', '1,2,4,89'); // Tipos de imóveis busca pronta home.

// END BUSCAS PRONTAS HOME

define('LATITUDE', '-10.205014');
define('LONGITUDE', '-48.3520826');

//Modulos do imoview.
define('TEM_MODULO_CAPTACAO', 1); //CAPITACAO
define('EXIBIR_CONTATO_NO_TOPO', 0); //exibir contatos no topo o site
define('EXIBIR_CAPTADOR', 0); //exibir contatos no topo o site

//PREENCHER CASO CLIENTE TENAH ESTEIRA DIGITAL
define('TEM_ESTEIRA_DIGITAL', 1); //COLOCAR 1 ATIVO, 0 PARA DESATIVADO.
define('CODIGO_CONVENIO', 3316); //CoDOGO DO CONVENIO preencher caso cliente tenha esteira


define('PADRAO_PARA_TITULO_DA_BUSCA_SEM_CIDADE_SELECIONADA', 'em Palmas e Região');
define('SESSION_UNIC', 'sessao_estilo');
define('IMOBILIARIA', 'Chitolina Imobiliária');
define('CIDADE', 'em Palmas');
define('CRECI', 'PJ 1234');

//PARA OS DADOS ESTRUTURADOS
define('ADDRESSLOCALITY', 'Palmas');
define('ADDRESSREGION', 'to');
define('DESCRIPTION', 'Compre, venda e Alugue imóveis em Palmas e região');
//FIM ESTRUTURA DE DADOS

//SEMPRE QUE ALTERAR AS VARIÁVEIS, PRECSIA ALTERA O NOME DA VARIAVEL  "SESSION_UNIC" ACIMA
define('EXIBIR_LACAMENTO_EM_MODAL', 0);

define('REGIAO_LOCALIZACAO_BASE', 'Palmas e Região');
define('STR_REGIAO_LOCALIZACAO_BASE', 'na Região de Palmas');
define('REGIAO_LOCALIZACAO_BASE_URL', 'regiao-de-palmas');
define('LINK_TRABALHE_CONOSCO', 'trabalhe-conosco');
define('TELEFONE_WHATSAPP', '(63) 9 8458-5555');

if (isset($_COOKIE['utm_source']) && !empty($_COOKIE['utm_source'])) {
    define('MENSAGEM_WHATSAPP_PADRAO', 'Olá, encontrei vocês através do '. $_COOKIE['utm_source'].', gostaria de mais informações.');
} else {
    define('MENSAGEM_WHATSAPP_PADRAO', 'Olá, estava navegando em seu site e gostaria de mais informações.');
}
//url de lançamentos para ser usada em todo o projeto
define('URL_BUSCA_LANCAMENTOS', '' . BASE_URL . 'venda/imovel/' . REGIAO_LOCALIZACAO_BASE_URL . '/todos-os-bairros/todos-os-condominios/apenas-lancamentos/');
define('IFRAMA_MAPA', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3926.6998229095907!2d-48.352082599999996!3d-10.205014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x933b34a537143a19%3A0xe54295fb74a69ddb!2sEstilo%20Imobili%C3%A1ria%20-%20imobili%C3%A1ria%20em%20Palmas%20Tocantins!5e0!3m2!1spt-BR!2sbr!4v1742478666669!5m2!1spt-BR!2sbr" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>');

//RENOVA A SESSAO A CADA 24 HORAS
if (!isset($_SESSION['CREATED']) || empty($_SESSION['CREATED'])) {

    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > 86400) { //86400

    $_SESSION[SESSION_UNIC] = [];

    session_unset();
    session_destroy();
}

$ChromeLighthouse   = stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse');
$Lighthouse         = stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse');
$GTmetrix           = stripos($_SERVER['HTTP_USER_AGENT'], 'GTmetrix');

//SITE 100% PAGE_SPEED_100
if ($ChromeLighthouse || $Lighthouse || $GTmetrix) {
    define("PAGE_SPEED_100", false); // aqui o valor precisa ser FALSE (eSTÁ TRUE para teste da GOCACHE)
} else {
    define("PAGE_SPEED_100", true);
}

//Make this Capsule instance available globally.
$capsule->setAsGlobal();

// Setup the Eloquent ORM.
$capsule->bootEloquent();

try {
    $capsule->getConnection()->getPdo(); // Testa a conexão 
} catch (\Exception $e) {
    include __DIR__ . "/views/pages/manutencao.php"; // Renderiza a view de erro
    exit;
}
