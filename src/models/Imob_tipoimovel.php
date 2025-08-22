<?php

namespace src\models;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Imob_tipoimovel extends EloquentModel
{

      // some attributes here…
      protected $table = 'imob_tipoimovel';
      private $tipo;


    public function __construct()
    {
        parent::__construct();
    }

    public function retornarTiposImoveisDisponiveis()
    {
        $dados = [];

        $dados['lista'] = $this->select(['nome', 'codigo'])
            ->orderBy('nome', 'asc')
            ->get()->toArray();

        return $dados;
    }
}
