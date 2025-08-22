<?php

namespace src\handlers;

/**
 * Description of SeoBusca
 *
 * @author Fagner
 */
class SeoBusca {

    public function gerarTipos($tipos) {
         $titulo = '';
     
        if (isset($tipos['tipos'])) {

            foreach ($tipos['tipos'] as $key => $b) {
              
                if ($key < (count($tipos['tipos']) - 1)) {

                    $titulo .= ucwords(str_replace('-', ' ', $b)) . ', ';
                    $params[$key] = ucwords($b);
                    
                } else {

                    $titulo .= ucwords(str_replace('-', ' ', $b));
                    $params[$key] = ucwords($b);
                }
            }
        } else {
            
            $titulo = '';
        }

      
        return $titulo;
    }

    public function getBairro($bairro) {

        $titulo = '';
 
        if (isset($bairro['bairros'])) {

            foreach ($bairro['bairros'] as $key => $b) {
              
                if ($key < (count($bairro['bairros']) - 1)) {

                    $titulo .= ucwords(str_replace('-', ' ', $b)) . ', ';
                    $params[$key] = ucwords($b);
                    
                } else {

                    $titulo .= ucwords(str_replace('-', ' ', $b));
                    $params[$key] = ucwords($b);
                }
            }
        } else {
            $titulo = 'Todos Os Bairros';
        }


        return $titulo;
    }

    public function getTitulo($dados) {
        
        $titulo = '';

        if (isset($dados['tipos']) && isset($dados['tipos'])){
            
            if($this->gerarTipos($dados) == 'Imovel'){
                $titulo = ($this->gerarTipos($dados) == 'Imovel' ? 'Imóveis' : $this->gerarTipos($dados)) . ($dados['finalidade'][0] == 'Venda' ? ' à venda' : ' para locação') . ($dados['cidades'][0] == REGIAO_LOCALIZACAO_BASE_URL || $dados['cidades'][0] == ' '.STR_REGIAO_LOCALIZACAO_BASE ? '.' : $dados['cidades'][0]) . ' | ' . IMOBILIARIA;
            } else {
                $titulo = ($this->gerarTipos($dados) == 'Imoveis' ? 'Imóveis' : $this->gerarTipos($dados)) . ($dados['finalidade'][0] == 'Venda' ? ' à venda' : ' para locação') . ($dados['cidades'][0] == REGIAO_LOCALIZACAO_BASE_URL || $dados['cidades'][0] == ' '.STR_REGIAO_LOCALIZACAO_BASE ? ' ' .PADRAO_PARA_TITULO_DA_BUSCA_SEM_CIDADE_SELECIONADA. '' : $dados['cidades'][0]) . ' | ' . IMOBILIARIA;;
            }
         }else{

       
            $titulo =  'Imóveis '.($dados['finalidade'][0] == 'Venda' ? ' à venda' : ' para locação') . ($dados['cidades'][0] == REGIAO_LOCALIZACAO_BASE_URL || $dados['cidades'][0] == ' '.STR_REGIAO_LOCALIZACAO_BASE ? ' ' .PADRAO_PARA_TITULO_DA_BUSCA_SEM_CIDADE_SELECIONADA. '' : $dados['cidades'][0]) . ' | ' . IMOBILIARIA;;
        }
 
        return $titulo;
    }

    public function getDescription($dados) {

        $descrica = '';
    

        $descrica = 'Na '.IMOBILIARIA.', você encontra '.
        ($this->gerarTipos($dados) == 'Imovel' ? 'imóveis' : $this->gerarTipos($dados)).
        ($dados['finalidade'][0] == 'Venda' ? ' à venda' : ' para alugar').
        ($this->getBairro($dados) == 'Todos Os Bairros'? ' '.($dados['cidades'][0] !=  STR_REGIAO_LOCALIZACAO_BASE ? $dados['cidades'][0].'!' : PADRAO_PARA_TITULO_DA_BUSCA_SEM_CIDADE_SELECIONADA.'!') : ' no bairro ' . $this->getBairro($dados).
        ($dados['cidades'][0] != STR_REGIAO_LOCALIZACAO_BASE.'!' ? $dados['cidades'][0].'!' : PADRAO_PARA_TITULO_DA_BUSCA_SEM_CIDADE_SELECIONADA.'!')).
        ' Escolha o seu imóvel e fale conosco!';
        
        return $descrica;
    }

}
