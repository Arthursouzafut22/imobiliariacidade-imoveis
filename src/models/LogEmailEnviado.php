<?php

namespace src\models;

// use \core\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;

use Illuminate\Support\Facades\DB;

class LogEmailEnviado extends EloquentModel
{
    // some attributes here…
    protected $table = 'log_email_enviado';
    public $timestamps = false;
    
   
    public function __construct()
    {
        parent::__construct();
    }

}
