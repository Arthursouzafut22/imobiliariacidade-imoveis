<?php

namespace src\controllers;
use \core\Controller;

class ManutencaoController extends Controller
{


    public function index()
    {
        $dados = [];
        $this->render('manutencao', $dados);
    }
}