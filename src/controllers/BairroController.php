<?php

namespace src\controllers;

use \core\Controller;
use src\handlers\Bairro;
use \src\handlers\UrlEncode;
use \src\models\BairroDAO;
use src\models\Imob_bairro;
use src\models\ImobBairro;

class BairroController extends Controller {


    public function retornarBairrosDisponiveis() {

        $request = $this->getRequestData();
    
        $b = new ImobBairro();
        $u = new UrlEncode();
        
        $bairros = $b->retornarBairrosDisponiveis($request);

        foreach ($bairros['lista'] as $key => $b) {
     
            $bairros['lista'][$key]['urlAmigavel'] = $u->amigavelURL($b['nomebairro']);
            $bairros['lista'][$key]['urlCidadeAmigavel'] = $u->amigavelURL($b['nomecidade']);
            $bairros['lista'][$key]['urlEstadoAmigavel'] = $u->amigavelURL($b['estado']);
        }

        header('Content-Type: application/json');
        echo json_encode($bairros);
    }

}
