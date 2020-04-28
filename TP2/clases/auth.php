<?php

namespace auth;

use \Firebase\JWT\JWT;

class Auth{

    public static function encode($entity){
        $key = "claveSecreta";
        $payload = array(
            "iss" => "https://github.com/MichelleCharotti/Prog3",
            "aud" => "https://github.com/MichelleCharotti/Prog3",
            "iat" => 1356999524,
            "nbf" => 1357000000,
            "nombre" => $entity->nombre, 
            "email" => $entity->email
        );
       
        return JWT::encode($payload, $key);
    }

    public static function decode($jwt){
        $key = "claveSecreta";
        return JWT::decode($jwt, $key, array('HS256'));
    }

}
?>