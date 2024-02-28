<?php

namespace controllers;

use stdClass;
use db\Connection;
use handlers\Errors;
use models\Personas;
use jwt\JasonWebToken;
use models\Credenciales;
use webservice\Webservice;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PersonaController extends Errors{

    /**
    * Valida los parametos de la ruta, genera jwt, 
    * envia peticion al ws para recuperar datos de una persona y actualiza los datos de la persona solicitada
    *
    * @param Request  $request
    * @param Response $response
    * @param array    $args                             ["id" => int,"brand" => string]
    *
    * @return string JSON $response                     {"estado": int,"mensaje":string}
    */
    public function updatePersona(Request $request, Response $response, $args)
    {
            $id     =   $args['id'];
            $brand  =   $args['brand'];

            try {
                new Connection();

                $user       = Personas::find($id);
                $credential = Credenciales::where('brand',$brand)->first(['client_id','secret_id']);

                //si no existe el id de la persona y la marca solicitada devuelve error de peticion incorrecta
                if(is_null($credential) || is_null($user) ){

                    $response->getBody()->write(json_encode($this->statusHandle(400)));
                    
                    return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
                }

                $credentialArray = $credential->toArray();

                $token  = JasonWebToken::encodeJwt($user::count(), $credentialArray['client_id'], $credentialArray['secret_id']);

                $respWs = Webservice::executeWs($token, $credentialArray['secret_id']);

                //si la respuesta del ws es obj, se actualizan los datos de la persona, sino devuelve error de autenticacion
                if(is_object($respWs)){

                    $this->savePersona($id,$respWs);
                    $response->getBody()->write(json_encode($this->statusHandle(200)));
                }else{
                    $response->getBody()->write(json_encode($this->statusHandle(401)));
                }
        
                return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        
            } catch (\Throwable $th) {
        
                $response->getBody()->write(json_encode($this->statusHandle(500)));

                return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
            }          

    }

    /**
    * actualiza el campo telefono de una persona y lo guarda en bbdd
    *
    * @param string    $id                            id de la persona solicitada
    * @param stdClass  $data                          datos de una persona
    */
    private function savePersona(string $id, stdClass $data){   

        Personas::where('id', $id)
        ->update(['telefono'=> $data->telefono]);

    }


}