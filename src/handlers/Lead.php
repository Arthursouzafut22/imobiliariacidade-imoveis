<?php

namespace src\handlers;

class Lead {

    public $nome = ''; // OBRIGATÓRIO - Enviar o nome do lead preenchido no formulário
    public $telefone = ''; // OPCIONAL - Enviar o telefone do lead, OBRIGATÓRIO se não tiver e-mail
    public $email = ''; //OPCIONAL - Enviar o e-mail do lead, OBRIGATÓRIO se não tiver telefone
    public $midia = ''; // OBRIGATÓRIO - Enviar nome da mídia de captação
    public $finalidade = ''; //OPCIONAL - Enviar 1 para ALUGUEL, 2 para VENDA, outro valor assume VENDA
    public $codigounidade = ''; // OPCIONAL - Enviar código da unidade se tiver ou será assumido a unidade do imóvel
    public $codigoimovel = ''; // OPCIONAL - Enviar código do imóvel para direcionar o atendimento e perfil da procura
    public $campanha = ''; // OPCIONAL - Enviar nome da campanha
    public $anotacoes = ''; // OPCIONAL - Enviar texto informado pelo lead
    public $emailcorretor = ''; // OPCIONAL - E-mail do corretor/MQL para envio direto de atendimento, sem fila

    function __construct() {
        
    }

    public function getParamtrosApi() {

        return [
            'nome' => $this->getNome(),
            'telefone' => $this->getTelefone(),
            'email' => $this->getEmail(),
            'anotacoes' => $this->getAnotacoes(),
            'codigoimovel' => $this->getCodigoimovel(),
        ];
    }
    
    function getNome() {
        return $this->nome;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getEmail() {
        return $this->email;
    }

    function getMidia() {
        return $this->midia;
    }

    function getFinalidade() {
        return $this->finalidade;
    }

    function getCodigounidade() {
        return $this->codigounidade;
    }

    function getCodigoimovel() {
        return $this->codigoimovel;
    }

    function getCampanha() {
        return $this->campanha;
    }

    function getAnotacoes() {
        return $this->anotacoes;
    }

    function getEmailcorretor() {
        return $this->emailcorretor;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setMidia($midia) {
        $this->midia = $midia;
    }

    function setFinalidade($finalidade) {
        $this->finalidade = $finalidade;
    }

    function setCodigounidade($codigounidade) {
        $this->codigounidade = $codigounidade;
    }

    function setCodigoimovel($codigoimovel) {
        $this->codigoimovel = $codigoimovel;
    }

    function setCampanha($campanha) {
        $this->campanha = $campanha;
    }

    function setAnotacoes($anotacoes) {
        $this->anotacoes = $anotacoes;
    }

    function setEmailcorretor($emailcorretor) {
        $this->emailcorretor = $emailcorretor;
    }


    

}
