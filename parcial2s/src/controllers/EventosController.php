<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Evento;
use App\Models\Usuario;
use App\Utils\RtaJsend;
use App\Utils\ValidarPost;
use Config\Database;
use Slim\Routing\RouteContext;//
use \Firebase\JWT\JWT;

class EventosController {

    public function registrarEventos(Request $request, Response $response, $args){
        $evento = new Evento();

        $datosARegistrar = $request->getParsedBody() ?? [];
        
        $token = $request->getheaders()['token'][0] ?? null;//

        if(empty($datosARegistrar)){
            $rta = RtaJsend::JsendResponse('Registro Evento ERROR','No se recibieron datos para registrar');
        } else {
            $evento = ValidarPost::RegistroEvento($evento, $datosARegistrar,$token);
            $rta = RtaJsend::JsendResponse('Registro Evento',(($evento->save()) ? 'ok' : 'error'));
        }
        $response->getBody()->write($rta);
        return $response;
    }

    public function mostrarEventos(Request $request, Response $response, $args){
    
        $token = $request->getheaders()['token'][0] ?? null;
        $success = false;
        $data = 'Hay un error en los datos enviados';
        $usuario_leidoSQL = Usuario::all()->where('clave',$token)->first();

        echo $usuario_leidoSQL;

        if(isset($token)){
            try{
                $user = JWT::decode($token,'Password', array('HS256'))[0]; //decodifica clave token
                
                //
                if(isset($usuario_leidoSQL) && isset($usuario_leidoSQL->tipo)){
                    if($usuario_leidoSQL->tipo == '1'){
                        $queryResult = Evento::where('usuario', $usuario_leidoSQL->id)->orderBy('fecha', 'desc')->get();
                        $success = isset($queryResult);
                        $data = $success ? $queryResult : 'No pudo obtenerse el dato deseado';
                    }else if($usuario_leidoSQL->tipo == '2'){
                        $queryResult = Evento::select('eventos.id','usuarios.email','fecha', 'descripcion')
                        ->join('usuarios', 'eventos.usuario', '=', 'usuarios.id')
                        ->orderBy('fecha', 'desc')
                        ->orderBy('usuarios.email', 'asc')
                        ->get();

                        $success = isset($queryResult);
                        $data = $success ? $queryResult : 'No pudo obtenerse el dato deseado';                       
                    }else{
                        $data = 'Error en el tipo de usuario';
                    }
                }else{
                    $data = 'Hubo un problema obteniendo el usuario del token';
                }
                //
            }catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
        }
        $rta = RtaJsend::JsendResponse('success',array('Historial de eventos'=>$data));
        $response->getBody()->write($rta);
        return $response;
    }

    public function modificarEvento(Request $request, Response $response, $args)
    {  
        $params = $request->getParsedBody() ?? null;
        $token = $request->getheaders()['token'][0] ?? null;
        $fecha = $request->getheaders()['fecha'][0] ?? null;
        $success = false;
        $data = 'Hay un error en los datos enviados';

            try{
                $user = Usuario::all()->where('clave',$token)->first();
                echo $user;

                $idEvento = $args['id'];
                if(isset($user) && $user->tipo == '1'){

                        if(Evento::where('id', $idEvento)->exists()){
                            $updateResult = Evento::where('id', $idEvento)->update(['fecha' => $fecha]);

                            $success = $updateResult == 1;
                            $data = $success ? 'Registro actualizado exitosamente': $data;
                        }else{
                            $data = 'No existe vento con el id indicado';
                        }
                }else{
                    $data = 'El usuario del token no es de tipo user';
                }
            }catch(Exception $e){
                $response->getBody()->write(RtaJsend::JsendResponse($success, $data));
                return $response;
            }

        $response->getBody()->write(RtaJsend::JsendResponse($success, $data));
        return $response;
    }


}
?>