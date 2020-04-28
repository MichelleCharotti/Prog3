<?php
require_once './composerTest/vendor/autoload.php';
require_once './control/entityController.php';
require_once './clases/entity.php';

use entityController\EntityController;
use entity\Entity;

session_start();

$queryParam = $_SERVER['QUERY_STRING'];
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '';

switch ($method) {
    case 'POST':
        switch (strtolower($path)) {
            case '/signin':
                    $entity = new Entity($_POST['nombre'],$_POST['apellido'],$_POST['telefono'],$_POST['email'],$_POST['clave'],$_POST['tipo']);
                    $resp = EntityController::signIn($entity);
                    echo "Se registro"." ".json_encode($resp);
                break;

            case '/login':
                    $response = EntityController::login($_POST['email'],$_POST['clave']);
                    echo json_encode($response);

                    if($response->status === 'success')
                    {    
                        $_SESSION['email'] = $_POST['email'];
                        $_SESSION['tipo'] = EntityController::userRole($_POST['email']);
                        $_SESSION['token'] = $response->data;
                    }
                else{
                    echo "ERROR";
                }
                break;
            
            default:
                echo "Path Not Found";
                break;
        }
        break;

    case 'GET':
        switch (strtolower($path)) {
            case '/detalle':
                $headers = getallheaders();
                $token = $headers['token'] ?? 'none';
                $sessionToken = $_SESSION['token'] ?? '';

                if($token==$sessionToken){
                    $response = EntityController::GetDetalle($_SESSION['email']);
                    echo json_encode($response);              
                }
                else{
                    echo "Token invalido";
                }
                    break;

            case '/lista':

                $headers = getallheaders();
                $token = $headers['token'] ?? 'none';
                $sessionToken = $_SESSION['token'] ?? '';

                if($token==$sessionToken){
                    $response = EntityController::GetLista($_SESSION['tipo']);
                    echo json_encode($response);
                }
                else{
                    echo "Token invalido";
                    
                }
                    break;

            case '/logout':

                $session = $_SESSION['email'] ?? false;

                if($session===false){
                    echo "No ha iniciado sesion";
                }
                else{
                    echo $_SESSION['email']." sesion cerrada";
                    session_destroy();
                }
                break;

            default:
                echo "Path Not Found";
                break;
        }
        break;
    
    default:
        echo "Metodo incorrecto";
        break;
}


?>










