<?php
namespace src\models;

// use \core\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class CmsRedeSocial extends EloquentModel
{
    // some attributes here…
    protected $table = 'cms_rede_social';
    public $timestamps = false;
    
    public function __construct()
    {
        parent::__construct();
    }

}
