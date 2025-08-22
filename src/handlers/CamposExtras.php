<?php

class CamposExtras {

    private $finalidade = ''; // OPCIONAL - Enviar 1 para ALUGUEL, 2 para VENDA ou 0 para todos
    private $opcaoimovel = ''; //OPCIONAL - Enviar 1 para somente avulsos, 2 para somente lançamentos, 3 para unidades de lançamentos, 4 para avulsos e lançamentos mãe, 0 para todos (avulsos e lançamentos por tipo e m²)

    public function __contructor() {
        
    }
    
    function getFinalidade() {
        return $this->finalidade;
    }

    function getOpcaoimovel() {
        return $this->opcaoimovel;
    }

    function setFinalidade($finalidade) {
        $this->finalidade = $finalidade;
    }

    function setOpcaoimovel($opcaoimovel) {
        $this->opcaoimovel = $opcaoimovel;
    }


    
    

}
