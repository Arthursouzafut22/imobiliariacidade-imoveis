<?php

namespace src\models;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Imob_imovel_caracteristica_extra extends EloquentModel
{

    protected $table = 'imob_imovel_caracteristica_extra';

  

    public function caracteristicasExtras()
{
    return $this->belongsToMany(Imob_caracteristica_extra::class, 'imob_imovel_caracteristica_extra', 'codigoimovel', 'codigocaracteristicaextra');
}

    public function __construct()
    {
        parent::__construct();
    }

    

}
