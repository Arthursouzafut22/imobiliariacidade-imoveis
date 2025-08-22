<?php

namespace src\models;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Imob_caracteristica_extra extends EloquentModel
{

    protected $table = 'imob_caracteristica_extra';

    protected $primaryKey = 'codigo'; // Defina a chave primária, se necessário


    public function __construct()
    {
        parent::__construct();
    }

    
    
    public function retornarCamposExtrasDisponiveis()
    {
        $dados = [];

        $dados['lista'] = $this->select('*')
            ->orderBy('nome', 'asc')
            ->get()->toArray();

        return $dados;

    }
}
