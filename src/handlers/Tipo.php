<?php

namespace src\handlers;

class Tipo {

    private $finalidade = 0; //OPCIONAL - Enviar 1 para ALUGUEL, 2 para VENDA ou 0 para todos
    private $codigoCidade = 0; // OPCIONAL - Enviar o código da cidade selecionada de acordo com a lista existente (RetornarCidadesDisponiveis) ou 0 para todos
    private $opcaoimovel = 0; //OPCIONAL - Enviar 1 para somente avulsos, 2 para somente lançamentos, 3 para unidades de lançamentos, 4 para avulsos e lançamentos mãe, 0 para todos (avulsos e lançamentos por tipo e m²)

    public function __contructor() {}
     

    public function getParamtrosApi() {

        return [
            'finalidade' => $this->getFinalidade(),
            'codigoCidade' => $this->getCodigoCidade(),
            'opcaoimovel' => $this->getOpcaoimovel(),
        ];
        
    }

    function getFinalidade() {
        
        return $this->finalidade;
        
    }

    function getCodigoCidade() {
        
        return $this->codigoCidade;
        
    }

    function getOpcaoimovel() {
        
        return $this->opcaoimovel;
        
    }

    function setFinalidade($finalidade) {
        
        if($finalidade == 'venda' || $finalidade == 'comprar'){

            $this->finalidade = 2;

        }else if($finalidade == 'aluguel' || $finalidade == 'alugar'){

            $this->finalidade = 1;

        }
    }

    function setCodigoCidade($codigoCidade) {
        
        $this->codigoCidade = $codigoCidade;
        
    }

    function setOpcaoimovel($opcaoimovel) {
        
        $this->opcaoimovel = $opcaoimovel;
        
    }

}
