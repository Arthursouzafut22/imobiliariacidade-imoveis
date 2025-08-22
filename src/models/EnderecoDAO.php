<?php

namespace src\models;

use core\ModelImovel;
use \src\handlers\Api;
use \src\Config;


class EnderecoDAO extends ModelImovel
{

  private $endereco;
  private $url = '';

  public function __construct($e)
  {
    parent::__construct();

    $this->endereco = $e;
    $this->api = new Api();
    $this->url = Config::URL_API . 'Imovel/PesquisarCidadeEBairrosDisponiveis';
  }

  public function retornarEnderecoDisponiveis()
  {

    $textoPesquisa = '%' . $this->endereco->getTextoPesquisa() . '%';

    $dados['bairros'] = Imob_bairro::select([
        'imob_bairro.codigo as codigobairro',
        'imob_cidade.nome as nomecidade',
        'imob_bairro.nome as nomebairro',
        'imob_cidade.nomeurlamigavel as url_amigavel_cidade',
        'imob_bairro.nomeurlamigavel as url_amigavel_bairro'
      ])
      ->join('imob_cidade', 'imob_bairro.codigocidade', '=', 'imob_cidade.codigo')
      ->where('imob_bairro.nome', 'LIKE', $textoPesquisa)->orderBy('nomebairro', 'asc')->get();

    $dados['cidades'] = Imob_cidade::select()->where('nome', 'LIKE', $textoPesquisa)->orderBy('nome', 'asc')->get();
    
    
    //$dados['endereco'] =  Imob_imovel::select('endereco')->where('endereco', 'LIKE',  $textoPesquisa)->get();

    return $dados;

  }

}
