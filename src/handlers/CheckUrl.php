<?php

namespace src\handlers;

use \src\handlers\UrlEncode;
use \src\handlers\Imovel;
use \src\handlers\Tipo;
use \src\handlers\Cidade;
use \src\handlers\Bairro;
use src\models\Imob_bairro;
use src\models\Imob_cidade;
use src\models\Imob_condominio;
use src\models\Imob_tipoimovel;
use src\models\ImobBairro;
use \src\models\TipoDAO;
use \src\models\CidadeDAO;
use \src\models\BairroDAO;
use \src\models\EdificioDAO;

class CheckUrl
{

    function __construct()
    {
    }

    public function checkURL($params)
    {

        $counter = 0;

        if (isset($params['finalidade']) && !empty($params['finalidade'])) {

            if ($params['finalidade'] == 'venda' || $params['finalidade'] == 'aluguel') {
                $counter++;
            }

            if ($counter == 0) {
                return true;
                // exit;

            } else {

                $counter = 0;
            }
        }
      
      
        if (isset($params['tipos']) && !empty($params['tipos']) && $params['tipos'] != "imovel") {

            $tipos_url = explode('+', $params['tipos']);

            foreach ($tipos_url as $key_url => $tipo_url) {

                foreach ($_SESSION[SESSION_UNIC]['tipos'] as $key => $tipo) {

                    if ($tipo['url_amigavel'] == $tipo_url || $params['tipos'] == 'imovel' || $params['tipos'] == 'imoveis') {
                        $counter++;
                    }
                }
            }
     
            if ($counter <= 0 ) {
                return true;
            }
            else {
                $counter = 0;
            }
        }
    

        if (isset($params['cidades']) && !empty($params['cidades']) && $params['cidades'] != REGIAO_LOCALIZACAO_BASE_URL) {
            
            foreach ($_SESSION[SESSION_UNIC]['cidades'] as $key => $cidade) {

                if ($cidade['nomeUrl'] == $params['cidades'] || $params['cidades'] == REGIAO_LOCALIZACAO_BASE_URL) {
                    $counter++;
                }
            }

            if ($counter == 0) {
                return true;
           
            } else {

                $counter = 0;
            }
        }



        if (isset($params['bairros']) && !empty($params['bairros'] && $params['bairros'] != 'todos-os-bairros')) {

            $bairros_url = explode('+', $params['bairros']);

            foreach ($_SESSION[SESSION_UNIC]['bairros'] as $key => $bairro) {
                foreach ($bairros_url as $key_url => $bairro_url) {
                    if (($bairro['nomeUrl'] == $bairro_url || $params['bairros'] == 'todos-os-bairros') && ($bairro['cidadeUrl'] == REGIAO_LOCALIZACAO_BASE_URL || $bairro['cidadeUrl'] == $params['cidades'])) {
                        $counter++;
                    }
                }
            }
        
            if ($counter == 0) {
                return true;
            
            }else {

                $counter = 0;
            }
        }

  

        if (isset($params['condominio']) && !empty($params['condominio']) && $params['condominio'] != 'todos-os-condominios') {

    
            foreach ($_SESSION[SESSION_UNIC]['condominios'] as $key => $condominio) {

                if ($condominio['nomeUrl'] == $params['condominio']) {
                    $counter++;
                }
            }

            if($counter == 0){
                return true;
                // exit;
            }
            else{
                $counter = 0;
            }
        }


     

        return false;
    }

    public function getParametrosGeraisCheck()
    {

        $dados = [];

        $url = new UrlEncode();
     
        $tipoDAO = new Imob_tipoimovel(new Tipo());
        $tipos = $tipoDAO->retornarTiposImoveisDisponiveis();
        foreach ($tipos['lista'] as $key => $t) {
            $tipos['lista'][$key]['url_amigavel'] = $url->amigavelURL($t['nome']);
        }

        $cidadeDAO = new Imob_cidade(new Cidade());
        $cidade = $cidadeDAO->retornarCidadeDisponiveis();
        foreach ($cidade['lista'] as $key => $value) {
            $cidade['lista'][$key]['nomeUrl'] = $url->amigavelURL($value['nome']);
            $cidade['lista'][$key]['estadoUrl'] = $url->amigavelURL($value['estado']);
        }
    
    
        $bairroDAO = new ImobBairro();
        $bairros['lista'] = $bairroDAO->select([
            'imob_cidade.nome as nomecidade',
            'imob_cidade.nome as cidade',
            'imob_bairro.nome as nomebairro',
            'imob_bairro.codigo as codigobairro',
            'imob_cidade.estado',
        ])
            ->join('imob_cidade', 'imob_bairro.codigocidade', '=', 'imob_cidade.codigo')
            ->orderBy('nomebairro', 'asc')
            ->get()->toArray();

      
        foreach ($bairros['lista'] as $key => $value) {
            $bairros['lista'][$key]['cidadeUrl'] = $url->amigavelURL($value['nomecidade']);
            $bairros['lista'][$key]['nome'] = $value['nomebairro'];
            $bairros['lista'][$key]['codigo'] = $value['codigobairro'];
            $bairros['lista'][$key]['nomeUrl'] = $url->amigavelURL($value['nomebairro']);
            $bairros['lista'][$key]['estadoUrl'] = $url->amigavelURL($value['estado']);
        }
    

        $imovelCond = new imovel();
        $imovelCond->setNumeroregistros(1000);
        $imovelCond->setRetornoReduzido(true);
        $imovelCond->setFinalidade(0);
        
        $condDAO = new Imob_condominio();
        $cond = $condDAO->retornarCondominiosDisponiveis();
        
        foreach ($cond['lista'] as $key => $value) {
            $cond['lista'][$key]['nomeUrl'] = $url->amigavelURL($value['nome']);
        }

        $dados['tipos'] = $tipos['lista'];
        $dados['cidades'] = $cidade['lista'];
        $dados['bairros'] = $bairros['lista'];
        $dados['condominios'] = $cond['lista'];

        $_SESSION[SESSION_UNIC] = $dados;

    }
}
