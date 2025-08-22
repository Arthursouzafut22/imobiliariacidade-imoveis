<?php

namespace src\models;

// use \core\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class CmsPaginaConteudoImagem extends EloquentModel
{
    // some attributes here…
    protected $table = 'cms_pagina_conteudo_imagem';
    public $timestamps = false;
    
   
    public function __construct()
    {
        parent::__construct();
    }

}
