<?php

namespace src\handlers;

class Bairro {

    private $finalidade = 0; //OPCIONAL - Enviar 1 para ALUGUEL, 2 para VENDA ou 0 para todos
    private $codigoTipo = 0; //OPCIONAL - Enviar o código do tipo de imóvel selecionado de acordo com a lista existente (RetornarTiposImoveisDisponiveis) ou 0 para todos
    private $codigoCidade = 0; //OPCIONAL - Enviar o código da cidade selecionada de acordo com a lista existente (RetornarCidadesDisponiveis) ou 0 para todos
    private $codigoRegiao = 0;  //OPCIONAL - Enviar o código da região selecionada de acordo com a lista existente (RetornarRegioesDisponiveis) ou 0 para todos
    private $opcaoimovel = 0;  //OPCIONAL - Enviar 1 para somente avulsos, 2 para somente lançamentos, 3 para unidades de lançamentos, 4 para avulsos e lançamentos mãe, 0 para todos (avulsos e lançamentos por tipo e m²)

    public function __contructor() {
        
    }

    public function getParamtrosApi() {

        return [
            'finalidade' => $this->getFinalidade(),
            'codigoTipo' => $this->getCodigoTipo(),
            'codigoCidade' => $this->getCodigoCidade(),
            'codigoRegiao' => $this->getCodigoRegiao(),
            'opcaoimovel' => $this->getOpcaoimovel(),
        ];
    }

    function getFinalidade() {
        return $this->finalidade;
    }

    function getCodigoTipo() {
        return $this->codigoTipo;
    }

    function getCodigoCidade() {
        return $this->codigoCidade;
    }

    function getCodigoRegiao() {
        return $this->codigoRegiao;
    }

    function getOpcaoimovel() {
        return $this->opcaoimovel;
    }

    function setFinalidade($finalidade) {
        $this->finalidade = $finalidade;
    }

    function setCodigoTipo($codigoTipo) {
        $this->codigoTipo = $codigoTipo;
    }

    function setCodigoCidade($codigoCidade) {
        $this->codigoCidade = $codigoCidade;
    }

    function setCodigoRegiao($codigoRegiao) {
        $this->codigoRegiao = $codigoRegiao;
    }

    function setOpcaoimovel($opcaoimovel) {
        $this->opcaoimovel = $opcaoimovel;
    }

}
