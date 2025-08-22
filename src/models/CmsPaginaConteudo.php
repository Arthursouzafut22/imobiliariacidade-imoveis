<?php

namespace src\models;

// use \core\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class CmsPaginaConteudo extends EloquentModel
{
    // some attributes here…
    protected $table = 'cms_pagina_conteudo';
    public $timestamps = false;
    
   
    public function __construct()
    {
        parent::__construct();
    }

    public function imagens()
    {
        return $this->hasMany(CmsPaginaConteudoImagem::class, 'cod_pagina_conteudo', 'cod_pagina_conteudo');
    }

    

}
