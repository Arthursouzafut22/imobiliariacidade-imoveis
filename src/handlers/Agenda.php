<?php

namespace src\handlers;

class Agenda {
    
    private $codigoimovel = 0; 
    private $data = 0; 
    
    public function __construct() {
     
    }
    
    public function getParamtrosApi() {
        
        return [
            'codigoimovel'=>(string)$this->getCodigoimovel(),
            'data'=> $this->getData(),
        ];
        
    }
    
    function getCodigoimovel() {
        return $this->codigoimovel;
    }

    function getData() {
        return $this->data;
    }

    function setCodigoimovel($codigoimovel) {
        $this->codigoimovel = $codigoimovel;
    }

    function setData($data) {
        $this->data = $data;
    }

}
