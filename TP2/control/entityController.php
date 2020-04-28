<?php

namespace entityController;

require_once './clases/response.php';
require_once './clases/data.php';
require_once './clases/auth.php';


use response\Response;
use data\Data;
use auth\Auth;

class EntityController{

    public static function GetLista($tipo){
        $resp = new Response(" ");
        $users = Data::readAll();

        if(isset($users)){ 
            foreach ($users as $user) {
                if($user->tipo == $tipo){
                    array_push($resp->data,$user);
                }
            }
            return $resp;
        }
        else{
            $resp->status = 'fail';
            return $resp;
        }
    }


    public static function GetDetalle($email){
        $resp = new Response(" ");
        $users = Data::readAll();

        if(isset($users))
        {
            foreach ($users as $user) {
                if($user->email == $email){
                    $resp->data = $user;
                    return $resp;
                }
            }
            $resp->status = 'not found';
            return $resp;
        }
        else{
            $resp->status = 'fail';
            return $resp;
        }
    }


    public static function signIn($user){
        $resp = new Response($user);

        if(isset($user)){
            Data::save($user);
            return $resp;
        }
        else{
            $resp->status = 'error';
            return $resp;
        }       
    }


    public static function login($email,$clave){
        $resp = new Response();
            $users = Data::readAll();

            foreach ($users as $user) 
            {
                if($user->email == $email && $user->clave == $clave)
                {
                    $resp->data = Auth::encode($user);
                    return $resp;
                }
            }
             $resp->status = 'Login Failed, User Not Found';
             return $resp;
    }


    public static function userRole($userEmail){
        $users = Data::readAll();

        foreach($users as $user){
            if($user->email == $userEmail)
            return $user->tipo;
        }
    }
}
?>