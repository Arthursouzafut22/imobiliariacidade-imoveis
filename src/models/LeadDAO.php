<?php

namespace src\models;

use \src\handlers\Api;
use \src\Config;

class LeadDAO {

    private $tipo;
    private $url = '';

    public function __construct($t) {
       
        $this->tipo = $t;
        $this->api = new Api();
        $this->url = Config::URL_API . 'Lead/IncluirLead';
    }

    public function incluirLead($params) {

        return json_decode($this->api->POST($this->url, $params));
    }

}
