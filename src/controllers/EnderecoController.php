<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\UrlEncode;
use \src\handlers\Endereco;
use \src\models\EnderecoDAO;


class EnderecoController extends Controller
{

    public function index()
    {

        $dados = [];
        echo 'index';

        //$this->render('home', $dados);
    }

    public function retornarEnderecosDisponiveis()
    {

        $params = $this->getRequestData();
        $end = new Endereco();
        $end->setFinalidade($params['finalidade']);
        $end->setTextoPesquisa($params['localizacao']);
        // $end->setCodigoTipo($params['codigoTipo']);

        $busca = new EnderecoDAO($end);

        $retorno = $busca->retornarEnderecoDisponiveis();
        $url = new UrlEncode();

        foreach ($retorno['cidades'] as $key => $value) {

            $retorno['cidades'][$key]['nome_amigavel'] = $url->amigavelURL($value['nomeurlamigavel']);
        }


        foreach ($retorno['bairros'] as $key => $value) {

            $retorno['bairros'][$key]['nome_amigavel'] = $url->amigavelURL($value['url_amigavel_bairro']);
            $retorno['bairros'][$key]['nome_amigavel_cidade'] = $url->amigavelURL($value['url_amigavel_cidade']);
        }

        header('Content-Type: application/json');
        echo json_encode($retorno);
    }

}
