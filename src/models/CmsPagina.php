<?php

namespace src\models;

// use \core\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class CmsPagina extends EloquentModel
{
    // some attributes here…
    protected $table = 'cms_pagina';
    public $timestamps = false;
    
    public function conteudos()
    {
        return $this->hasMany(CmsPaginaConteudo::class, 'cod_pagina', 'cod_pagina')
            ->with('imagens'); // Relacionamento com as imagens
    }

    public function __construct()
    {
        parent::__construct();
    }

}
