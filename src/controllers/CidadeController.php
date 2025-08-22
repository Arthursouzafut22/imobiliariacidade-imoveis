<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\Cidade;
use \src\handlers\UrlEncode;
use \src\models\CidadeDAO;
use src\models\Imob_cidade;

class CidadeController extends Controller {

    public function index() {

        $dados = [];
        echo 'index';

        //$this->render('home', $dados);
    }

    public function retornarCidadeDisponiveis() {

        $c = new Cidade();
        $cm = new Imob_cidade($c);
        $u = new UrlEncode();

        $cidade = $cm->retornarCidadeDisponiveis();

        foreach ($cidade['lista'] as $key => $b) {
            $cidade['lista'][$key]['urlAmigavel'] = $u->amigavelURL($b['nome']);
            $cidade['lista'][$key]['urlEstadoAmigavel'] = $u->amigavelURL($b['estado']);
        }
       
        header('Content-Type: application/json');
        echo json_encode($cidade);
    }

}
