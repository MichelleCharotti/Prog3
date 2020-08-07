<?php
// Aca incluyo mis controladores
use Slim\Routing\RouteCollectorProxy;
use App\Controllers\UsuariosController;
use App\Controllers\EventosController;
use App\Middleware\TokenValidateMiddleware1;


return function($app){

    $app->group('/', function(RouteCollectorProxy $group){
        $group->post('users', UsuariosController::class.':registro');
        $group->post('login', UsuariosController::class.':login');
    });

    
    $app->group('/', function(RouteCollectorProxy $group){
        $group->post('eventos', EventosController::class.':registrarEventos');
        $group->get('eventos', EventosController::class.':mostrarEventos');
        $group->put('eventos/{id}', EventosController::class.':modificarEvento');
    })->add(new TokenValidateMiddleware1());

};
?>