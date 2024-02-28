<?php

namespace db;

use Illuminate\Database\Capsule\Manager as Capsule;

require __DIR__ . '/../../vendor/autoload.php';

class Connection extends Capsule{

   /**
   * @var Capsule
   */
    public $capsule = null;

    public function __construct(){
        
        $this->capsule = new Capsule;

        $this->capsule->addConnection([
            "driver"    => "pgsql",
            "host"      => "127.0.0.1",
            "database"  => "doc24",
            "username"  => "root",
            "password"  => "1234"
        ]);
       
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();

    }


}