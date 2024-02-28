<?php

namespace webservice;

use db\Connection;
use jwt\JasonWebToken;
use models\Personas;

require __DIR__ . '/../vendor/autoload.php';

class DatosPersona{

    /**
     * Verifica si el jwt es valido y devuelve los datos de una persona
     * 
     * @return string JSON $response               mensaje de error de autentificacion o json con los datos de una persona
     */
    public function __construct(){
        
        $response = JasonWebToken::decodeJwt($_SERVER['HTTP_AUTORIZATION'],$_SERVER['HTTP_SECRETID']);

        //si la respuesta es un obj, devuelve los datos de una persona
        if(is_object($response)){

            new Connection();
            
            $user       = Personas::find(rand(1,$response->data->total_personas));
            $response   = $user->toArray();
            unset($response["id"]);
        }

        echo json_encode($response);
        exit;
    }


}

$obj = new DatosPersona();






