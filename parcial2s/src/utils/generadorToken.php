<?php

namespace App\Utils;
use \Firebase\JWT\JWT;

class GeneradorToken{
    static public function GenerarTokenJWTPassword($password_a_encriptar){
        // Encripto el password recibido por $datosSinValidar y lo guardo
        $key = "Password";
        $payload = array($password_a_encriptar);
        $password_jwt = JWT::encode($payload, $key);
        return $password_jwt;
    }

    static public function GenerarTokenJWTHeader($usuario_leidoSQL, $password_decodificado){
        $key = "Segundo_Parcial_Programacion3";
        $payload = array(
            'id' => $usuario_leidoSQL->id,
            'mail' => $usuario_leidoSQL->email,
            'nombre' => $usuario_leidoSQL->nombre,
            'clave' => $password_decodificado,
            'tipo' => $usuario_leidoSQL->tipo,
        );
        $jwt = JWT::encode($payload, $key);
        $rta = RtaJsend::JsendResponse("success", array("token" => $jwt));
        return $rta;
    }

 
}
?>