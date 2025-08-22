<?php
session_start();

$timeout = 3600 * 24 * 30; //setar 30 dias de sessao
// $timeout = 120;

// Defina o nome da sessão padrão
$s_name = 'nome_campanha';
$midia_origem = 'utm_source';
$midia_campanha = 'utm_campaign';


// Verifique se a sessão existe ou não
if (!isset($_COOKIE[$s_name]) && isset($_GET['nome_campanha'])) {
    setcookie($s_name, $_GET['nome_campanha'], time() + $timeout, '/');
    //  echo "Session foi criada para $s_name.<br/>";
}

if (!isset($_COOKIE[$midia_origem]) && isset($_GET['midia_origem'])) {
    setcookie($midia_origem, $_GET['midia_origem'], time() + $timeout, '/');
    //echo "Session foi criada para $s_name.<br/>";
}

if (!isset($_COOKIE[$midia_origem]) && isset($_GET['utm_content'])) {
    setcookie($midia_origem, $_GET['utm_content'], time() + $timeout, '/');
    //echo "Session foi criada para $s_name.<br/>";
}

if (!isset($_COOKIE[$midia_origem]) && isset($_GET['utm_medium'])) {
    setcookie($midia_origem, $_GET['utm_medium'], time() + $timeout, '/');
    //echo "Session foi criada para $s_name.<br/>";
}

if (!isset($_COOKIE[$midia_origem]) && isset($_GET['utm_campaign'])) {
    setcookie($midia_origem, $_GET['utm_campaign'], time() + $timeout, '/');
    //echo "Session foi criada para $s_name.<br/>";
}

if (!isset($_COOKIE[$midia_campanha]) && isset($_GET['utm_source'])) {
    setcookie($midia_campanha, $_GET['utm_source'], time() + $timeout, '/');
    //echo "Session foi criada para $s_name.<br/>";
}

if (!isset($_COOKIE[$midia_origem]) && isset($_GET['utm_term'])) {
    setcookie($midia_origem, $_GET['utm_term'], time() + $timeout, '/');
    //echo "Session foi criada para $s_name.<br/>";
}

if (!isset($_COOKIE[$midia_origem]) && isset($_GET['utm_referrer'])) {
    setcookie($midia_origem, $_GET['utm_referrer'], time() + $timeout, '/');
    //echo "Session foi criada para $s_name.<br/>";
}

if (!isset($_COOKIE[$midia_origem]) && isset($_GET['referrer'])) {
    setcookie($midia_origem, $_GET['referrer'], time() + $timeout, '/');
    //echo "Session foi criada para $s_name.<br/>";
}

if (!isset($_COOKIE[$midia_origem]) && isset($_GET['gclientid'])) {
    setcookie($midia_origem, $_GET['gclientid'], time() + $timeout, '/');
    //echo "Session foi criada para $s_name.<br/>";
}

if (!isset($_COOKIE[$midia_origem]) && isset($_GET['gclid'])) {
    setcookie($midia_origem, $_GET['gclid'], time() + $timeout, '/');
    //echo "Session foi criada para $s_name.<br/>";
}

if (!isset($_COOKIE[$midia_origem]) && isset($_GET['fbclid'])) {
    setcookie($midia_origem, $_GET['fbclid'], time() + $timeout, '/');
    //echo "Session foi criada para $s_name.<br/>";
}



require '../vendor/autoload.php';
require '../src/routes.php';

$router->run( $router->routes );


//?midia_origem=Google%20Ads%20(Site)&nome_campanha=8745