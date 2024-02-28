<?php

namespace jwt;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JasonWebToken{

    /**
     * Generar token de autenticacion y lo devuelve
     * 
     * @param  int    $totalPersonas                 numero total de personas en bbdd
     * @param  string $clientId                      client id de la tabla credenciales
     * @param  string $secretId                      secret id de la tabla credenciales
     * 
     * @return string $jwt                           token de autenticacion
     */
     public static function encodeJwt(int $totalPersonas, string $clientId, string $secretId){

        $time = time();

        $token = [
            'iat'  => $time,
            'exp'  => $time + (60 * 60 * 24),
            'data' =>[
                'client_id'     => $clientId,
                'secret_id'     => $secretId,
                'total_personas'=> $totalPersonas
            ],
        ];

        $jwt = JWT::encode($token, $secretId, 'HS256');

        return $jwt;
    }

    /**
     * Decodifica el token de autenticacion y devuelve los datos
     * 
     * @param  string   $token                         token de autenticacion
     * @param  string   $secretId                      secret id de la tabla credenciales
     * 
     * @return stdClass $data                          objeto con los datos del token
     * @throws Throwable                                
     */
     public static function decodeJwt(string $token, string $secretId){

        try {
            $data = JWT::decode($token,  new Key($secretId, 'HS256'));

            return $data;

        } catch (\Throwable $th) {

            return $th->GetMessage();
        }


    }


}