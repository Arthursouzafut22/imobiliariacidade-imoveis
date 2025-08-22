<?php

namespace src\models;


use \src\handlers\Api;
use \src\Config;

class CaptacaoPage 
{

    private $url = '';
    private $api = '';

    public function __construct()
    {
     
        $this->api = new Api();
        $this->url = Config::URL_API . 'Lead/IncluirLeadCaptacao';
    }

    public function incluirLead($params)
    {

        return json_decode($this->api->POST($this->url, $params));
    }
}
