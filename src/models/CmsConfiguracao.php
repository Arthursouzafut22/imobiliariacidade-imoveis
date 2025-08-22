<?php
namespace src\models;

// use \core\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Facades\DB;

class CmsConfiguracao extends EloquentModel
{
    // some attributes here…
    protected $table = 'cms_configuracao';
    public $timestamps = false;
    
   
    public function __construct()
    {
        parent::__construct();
    }

}
