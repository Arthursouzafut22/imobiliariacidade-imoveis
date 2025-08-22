<?php

namespace src\controllers;

use \core\Controller;

use src\handlers\Imovel;
use src\models\Imob_caracteristica_extra;


class CamposExtrasDisponiveisController extends Controller
{

    public function retornarCamposExtras()
    {

        $imovel = new Imovel();

        $camposExtras = new Imob_caracteristica_extra();
        $response = $camposExtras->retornarCamposExtrasDisponiveis();

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
