<?php

namespace App\Utils;
use \Firebase\JWT\JWT;
use App\Utils\GeneradorToken;
use App\Models\Usuario;
use App\Models\Evento;
use App\Utils\RtaJsend;

class ValidarPost{
    
    static public function RegistroUsuario($usuario, $datosPostSinValidar){
        $usuario->email = strtolower($datosPostSinValidar['email'] ?? '');
        $usuario->nombre = $datosPostSinValidar['nombre'] ?? '';

         // Verifico 
        if((strlen($datosPostSinValidar['clave']))>3)
        {
        $usuario->clave = GeneradorToken::GenerarTokenJWTPassword($datosPostSinValidar['clave']);
       
        $auxTipo = $datosPostSinValidar['tipo'] ?? '';
        if(($auxTipo != '') && (($auxTipo == 'user') || ($auxTipo == 'admin') || ($auxTipo == 'user'))){
            if($auxTipo == 'user'){
                $tipo = 1;
            } else if($auxTipo == 'admin'){
                $tipo = 2;
            } else {
                $tipo = 3;
            }
            $usuario->tipo = $tipo;
         } }else
        { $usuario = RtaJsend::JsendResponse('error','Password incorrecto');}
        return $usuario;
    }

    static public function LoginUsuario($usuario_leidoSQL, $password_recibido){
        try {
            $password_decodificado = JWT::decode($usuario_leidoSQL->clave,'Password', array('HS256'))[0];

            if($password_decodificado == $password_recibido){
                $rta = GeneradorToken::GenerarTokenJWTHeader($usuario_leidoSQL, $password_decodificado);
            } else {
                $rta = RtaJsend::JsendResponse('error','Password incorrecto');
            }
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }

        return $rta;
    }

    static public function RegistroEvento($evento, $datosPostSinValidar,$token){
        
$idUsuario = $datosPostSinValidar['id_usuario'] ?? '';
        $usuario_leidoSQL = Usuario::all()->where('id',$idUsuario)->first();
$password_decodificado = JWT::decode($usuario_leidoSQL->clave,'Password', array('HS256'))[0];
$password_decodificado_r = JWT::decode($token,'Password', array('HS256'))[0];

$data = 'Hay un error en los datos enviados';

 try {
            if($password_decodificado == $password_decodificado_r){

                if(($idUsuario != '') && ($usuario_leidoSQL->tipo == 1)){
           
                    $evento->usuario = $idUsuario;
                    $evento->fecha = $datosPostSinValidar['fecha'] ?? '';
                    $evento->descripcion = $datosPostSinValidar['descripcion'] ?? '';
                    echo $usuario_leidoSQL;

                   return $evento;
                 }
             }
        } catch (\Throwable $th) {
             var_dump($th->getMessage());
        } 

//
    }

   
}
?>