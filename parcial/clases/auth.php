<?php
require_once './composerTest/vendor/autoload.php';
use \Firebase\JWT\JWT;

class Token{
    public static function generarJWT($entity){
        $key = "pro3-parcial";
        $payload = array(
            "iss" => "https://github.com/MichelleCharotti/Prog3",
            "aud" => "https://github.com/MichelleCharotti/Prog3",
            "mail"=>$entity->email,
            "tipo"=>$entity->tipo,
            "user"=>$entity
        );
       
        return JWT::encode($payload, $key);
    }
    
    public static function validarJWT(){
        $key = "pro3-parcial";
        $header = getallheaders();
        $jwt=$header["token"] ?? " ";
        print_r ($jwt);
    
        try{
        return JWT::decode($jwt, $key, array('HS256'));
    }catch (\Throwable $th) {
               echo "error";
               print_r ($th->getMessage());
            }
    }
    }
    ?>