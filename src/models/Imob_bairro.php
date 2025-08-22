<?php

namespace src\models;

use Illuminate\Database\Eloquent\Model as EloquentModel;


class Imob_bairro extends EloquentModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function retornarBairrosDisponiveis($params)
    {
        $dados = [];

        $dados['lista'] = $this->select([
            'imob_cidade.nome as nomecidade',
            'imob_cidade.nome as cidade',
            'imob_bairro.nome as nomebairro',
            'imob_bairro.codigo as codigobairro',
            'imob_cidade.estado',
        ])
            ->join('imob_cidade', 'imob_bairro.codigocidade', '=', 'imob_cidade.codigo')
            ->when(isset($params['codigocidade']), function ($query) use ($params) {
                $query->where('imob_cidade.codigo', '=', $params['codigocidade']);
            })
            ->orderBy('nomebairro', 'asc')
            ->get();

        return $dados;
    }
   
}
