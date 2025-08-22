<?php

namespace src\models;

// use \core\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class CmsPaginaConteudoAnexo extends EloquentModel
{
    // some attributes here…
    protected $table = 'cms_pagina_conteudo_anexo';
    public $timestamps = false;
    
   
    public function __construct()
    {
        parent::__construct();
    }

}
