<?php

namespace src\models;
use Illuminate\Database\Eloquent\Model as EloquentModel;


class Imob_cidade extends EloquentModel
{


    protected $table = 'imob_cidade';

    public function __construct()
    {
        parent::__construct();
    }

    public function retornarCidadeDisponiveis()
    {
        $dados = [];

        $dados['lista'] = $this->select()
            ->orderBy('nome', 'asc')
            ->get()->toArray();

        return $dados;

    }
}
