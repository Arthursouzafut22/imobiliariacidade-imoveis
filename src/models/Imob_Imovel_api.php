<?php

namespace src\models;

use \core\Model;
use \src\handlers\Api;
use \src\Config;

class Imob_Imovel_api {

    private $imovel;
    private $params = [];
    private $url = '';

    public function __construct($imovel) {
        
        $this->imovel = $imovel;
        $this->api = new Api();
        $this->url = Config::URL_API . 'Imovel/RetornarImoveisDisponiveis';
    }

    public function retornarImoveisDisponiveis() {
        return json_decode($this->api->GET($this->url, $this->imovel->getParamtrosApi(), Config::CHAVE_API_IMOVIEW));
    }

    public function retornarDetalhesImoveiDisponivel() {

        return json_decode($this->api->GET(Config::URL_API.'Imovel/RetornarDetalhesImovelDisponivel', $this->imovel->getParamtrosDetalheImovelApi() , Config::CHAVE_API_IMOVIEW));
        
    }
}
