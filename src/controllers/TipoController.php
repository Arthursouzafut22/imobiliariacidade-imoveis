<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\Tipo;
use \src\handlers\UrlEncode;
use src\models\Imob_tipoimovel;

class TipoController extends Controller
{

    
    public function index()
    {
    }

    public function retornarTiposImoveisDisponiveis()
    {

        $dados = [];

        $params = $this->getRequestData();

        $t = new Tipo();
        $t->setFinalidade($params['finalidade']);
        $t->setCodigoCidade($params['codigocidade']);
        $t->setOpcaoimovel($params['opcaoimovel']);

        $tm = new Imob_tipoimovel($t);
        $u = new UrlEncode();

        $dados = $tm->retornarTiposImoveisDisponiveis();
      
        foreach ($dados['lista'] as $key => $t) {
            $dados['lista'][$key]['urlAmigavel'] = $u->amigavelURL($t['nome']);
        }

        header('Content-Type: application/json');
        echo json_encode($dados);
    }
}
