<?php

use db\Connection;

require __DIR__ . '/connection.php';

$insertRows = true;

$connection = new Connection();

$connection->capsule->schema()->create('personas', function ($table) {
       $table->increments('id');
       $table->string('nombre');
       $table->string('apellido');
       $table->integer('edad');
       $table->string('telefono');
   });

 if($insertRows){

    $data = [
        [
            'id' => '1',
            'nombre' => 'matias',
            'apellido' => 'vivaldi',
            'edad' => '33',
            'telefono' => '3413721990',
        ],
        [
            'id' => '2',
            'nombre' => 'pablo',
            'apellido' => 'martinez',
            'edad' => '28',
            'telefono' => '3416789066',
        ],
        [
            'id' => '3',
            'nombre' => 'marta',
            'apellido' => 'sanchez',
            'edad' => '40',
            'telefono' => '3412555444',
        ],
        [
            'id' => '4',
            'nombre' => 'lucia',
            'apellido' => 'martinachi',
            'edad' => '44',
            'telefono' => '3415767898',
        ],
    ];

    $div = 4;

    for ($i = 0; $i < intdiv(count($data), $div); $i++) {

        $new_arr = [];

        for ($j = ($i * $div); $j < (($i + 1) * $div); $j++) {
            $new_arr[] = $data[$j];
        }


        $connection->capsule->table('personas')->insert($new_arr);

    } 

}