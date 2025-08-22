<?php

namespace src\models;

// use \core\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class CmsScriptsExternos extends EloquentModel
{
    // some attributes here…
    protected $table = 'cms_scripts_externos';
    public $timestamps = false;
    
    public function __construct()
    {
        parent::__construct();
    }

}
