<?php

namespace src\models;
 
use \src\handlers\Api;
use \src\Config;


class AgendaDAO  {
    
    private $endereco;
    private $url = '';
    
    public function __construct($e) {
        
        
        $this->agenda = $e;
        $this->api = new Api();
        $this->url = Config::URL_API . 'Imovel/RetornarHorariosVisitasDisponiveis';
    }

    public function retornarHorariosVisitasDisponiveis() {

      return json_decode($this->api->GET(Config::URL_API .'Imovel/RetornarHorariosVisitasDisponiveis', $this->agenda->getParamtrosApi()));
      
    }
    
    public function incluirAgendamento($params) {

      return json_decode($this->api->POST(Config::URL_API .'Lead/IncluirAgendamentoVisita', $params));
      
    }
    
    

}
