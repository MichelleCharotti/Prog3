<?php   
require_once './composerTest/vendor/autoload.php';
require_once './clases/usuario.php';
require_once './clases/pizza.php';
require_once './clases/venta.php';

$request=$_SERVER['REQUEST_METHOD'];
$info=$_SERVER['PATH_INFO'];

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$usuario=new usuario();
$pizza=new pizza();
$venta=new venta();

if($request=='POST'){
switch($info){

    case '/usuario':
$usuario->cargarUsuario();
        break;
    case '/login':
        $usuario->loginUsuario();
    break;
    case '/pizzas':
        $pizza->cargarPizza();
    break;
    case '/ventas':
        $venta->cargarVenta();
    break;
    default: 
    echo "ERROR. Metodo incorrecto";
        break;
    }}

    if($request=='GET'){
        switch($info){
        
            case '/pizzas':
                $pizza->listarPizza();
                break;
            case '/ventas':
                $venta->listarVentas();
            break;
            default: 
            echo "ERROR. Metodo incorrecto";
                break;
            }} 
?>