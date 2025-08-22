<?php

namespace src\controllers;
use \core\Controller;


class SitesUniversalSoftwareController extends Controller {

    public function __construct()
    {
    }

    public function index() {

        // Permitir acesso de qualquer origem
        header("Access-Control-Allow-Origin: *");
        // Permitir cabeçalhos específicos
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        
        header("Content-Type:application/json");

        echo json_encode(["site_desenvolvido_universal_software" => true ]);
        exit;
        
    }
}