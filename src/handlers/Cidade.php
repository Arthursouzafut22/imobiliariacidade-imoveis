<?php

namespace src\handlers;

class Cidade {

    private $finalidade = 0; // OPCIONAL - Enviar 1 para ALUGUEL, 2 para VENDA ou 0 para todos
    private $codigoTipo = 0; //OPCIONAL - Enviar o código do tipo de imóvel selecionado de acordo com a lista existente (RetornarTiposImoveisDisponiveis) ou 0 para todos
    private $opcaoimovel = 0; //OPCIONAL - Enviar 1 para somente avulsos, 2 para somente lançamentos, 3 para unidades de lançamentos, 4 para avulsos e lançamentos mãe, 0 para todos (avulsos e lançamentos por tipo e m²)

    function __construct() {
        
    }

    public function getParamtrosApi() {

        return [
            'finalidade' => $this->getFinalidade(),
            'codigoTipo' => $this->getCodigoTipo(),
            'opcaoimovel' => $this->getOpcaoimovel(),
        ];
        
    }
    

    function getFinalidade() {
        return $this->finalidade;
    }

    function getCodigoTipo() {
        return $this->codigoTipo;
    }

    function getOpcaoimovel() {
        return $this->opcaoimovel;
    }

    function setFinalidade($finalidade) {

        if ($finalidade == 'venda' || $finalidade == 'comprar') {

            $this->finalidade = 2;
        } else if ($finalidade == 'aluguel' || $finalidade == 'alugar') {

            $this->finalidade = 1;
            
        } else {

            $this->finalidade = 0;
        }
    }

    function setCodigoTipo($codigoTipo) {
        $this->codigoTipo = $codigoTipo;
    }

    function setOpcaoimovel($opcaoimovel) {
        $this->opcaoimovel = $opcaoimovel;
    }

}
