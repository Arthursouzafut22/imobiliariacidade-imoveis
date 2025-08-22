<?php

namespace src\handlers;

class Endereco {

    private $finalidade = 0; //OPCIONAL - Enviar 1 para ALUGUEL, 2 para VENDA ou 0 para todos
    private $codigoTipo = 0; //OPCIONAL - Enviar o código do tipo de imóvel selecionado de acordo com a lista existente (RetornarTiposImoveisDisponiveis) ou 0 para todos
    private $opcaoImovel = 0; //OPCIONAL - Enviar 1 para somente avulsos, 2 para somente lançamentos, 3 para unidades de lançamentos, 4 para avulsos e lançamentos mãe, 0 para todos (avulsos e lançamentos por tipo e m²)
    private $textoPesquisa = ''; // OBRIGATÓRIO - Texto para pesquisar cidades, bairros e endereço, enviar no mínimo 3 caracteres
    private $pesquisarEndereco = true; //OPCIONAL - Enviar true se quiser retornar endereços pelo texto de pesquisa, máximo 20 registros

    function __construct(){
        
    }

    public function getParamtrosApi() {

        return [
            'finalidade' => $this->getFinalidade(),
            'codigoTipo' => $this->getCodigoTipo(),
            'opcaoImovel' => $this->getOpcaoimovel(),
            'textoPesquisa' => $this->getTextoPesquisa(),
            'pesquisarEndereco' => $this->getPesquisarEndereco(),
        ];
    }

    function getFinalidade() {
        return $this->finalidade;
    }

    function getCodigoTipo() {
        return $this->codigoTipo;
    }

    function getOpcaoImovel() {
        return $this->opcaoImovel;
    }

    function getTextoPesquisa() {
        return $this->textoPesquisa;
    }

    function getPesquisarEndereco() {
        return $this->pesquisarEndereco;
    }

    function setFinalidade($finalidade) {
        $this->finalidade = $finalidade;
    }

    function setCodigoTipo($codigoTipo) {
        $this->codigoTipo = $codigoTipo;
    }

    function setOpcaoImovel($opcaoImovel) {
        $this->opcaoImovel = $opcaoImovel;
    }

    function setTextoPesquisa($textoPesquisa) {
        $this->textoPesquisa = $textoPesquisa;
    }

    function setPesquisarEndereco($pesquisarEndereco) {
        $this->pesquisarEndereco = $pesquisarEndereco;
    }

}
