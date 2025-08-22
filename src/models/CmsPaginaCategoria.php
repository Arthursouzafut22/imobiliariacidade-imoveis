<?php

namespace src\models;

// use \core\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class CmsPaginaCategoria extends EloquentModel
{
    // some attributes here…
    protected $table = 'cms_pagina_categoria';
    public $timestamps = false;
    
   
    public function __construct()
    {
        parent::__construct();
    }

    public function paginas()
    {
        return $this->hasMany(CmsPagina::class, 'cod_pagina_categoria', 'cod_pagina_categoria');
    }

}
