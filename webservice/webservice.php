<?php

namespace webservice;


class Webservice{

    CONST BASE_URL = 'localhost/doc24';

    /**
     * Ejecuta el webservice
     * 
     * @param  string       $token                         token de autenticacion
     * @param  string       $secretId                      secret id de la tabla credenciales
     * 
     * @return string JSON  $return                        datos de una persona
     *                               
     */
     public static function executeWs(string $token, string $secretId){

        $header= ['AUTORIZATION:'.$token, 'SECRETID:'.$secretId];

        $ch = curl_init(self::BASE_URL."/webservice/datosPersona.php");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $return = json_decode(curl_exec($ch));

        curl_close($ch);

        return $return;

    }


}