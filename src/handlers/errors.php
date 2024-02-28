<?php

namespace handlers;


class Errors{

    CONST MESSAGE_200 = 'Datos Actualizados correctamente';
    CONST MESSAGE_400 = 'La peticion es incorrecta.';
    CONST MESSAGE_401 = 'Fallo en el token de autenticacion.';
    CONST MESSAGE_500 = 'Ha ocurrido un error al procesar la solicitud';


    /**
    * @var int
    */
    private $status = 0;

    /**
    * @var string
    */
    private $message = '';

    /**
     * Devuelve el estado y mensaje de acuerdo con el codigo de error
     * 
     * @param  int         $errorCode             codigo del error
     * 
     * @return array                       ["estado" => int,"mensaje" => string]
     *                               
     */
     public function statusHandle(int $errorCode){


        switch ($errorCode) {
            case 200:
                $this->status  = 1;
                $this->message = self::MESSAGE_200;
                break;
            case 400:
                $this->message = self::MESSAGE_400;
                break;
            case 401:
                $this->message = self::MESSAGE_401;
                break; 
            case 500:
                $this->message = self::MESSAGE_500;
                break;                
        }


        return $this->getResponse();
    }

    /**
     * Devuelve el estado y mensaje de acuerdo con el codigo de error
     * 
     * @return array                                                   
     */
    private function getResponse(){

        return ["estado" => $this->status, "mensaje" => $this->message];
    }


}