<?php

use db\Connection;

require __DIR__ . '/connection.php';

$insertRows = true;

$connection = new Connection();

$connection->capsule->schema()->create('credenciales', function ($table) {
       $table->increments('id');
       $table->string('brand');
       $table->string('client_id');
       $table->string('secret_id');
   });

if($insertRows){   

    $data = [
        [
            'id' => '1',
            'brand' => 'nike',
            'client_id' => 'matiasv',
            'secret_id' => '888',
        ],
        [
            'id' => '2',
            'brand' => 'adidas',
            'client_id' => 'pablom',
            'secret_id' => '456',
        ],
    ];

    $div = 2;

    for ($i = 0; $i < intdiv(count($data), $div); $i++) {

        $new_arr = [];

        for ($j = ($i * $div); $j < (($i + 1) * $div); $j++) {
            $new_arr[] = $data[$j];
        }


        $connection->capsule->table('credenciales')->insert($new_arr);

    }

}