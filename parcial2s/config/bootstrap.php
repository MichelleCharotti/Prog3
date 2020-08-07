<?php
require_once '../vendor/autoload.php';

error_reporting(E_ERROR | E_WARNING | E_PARSE);

use Config\Database;
new Database();

use Slim\Factory\AppFactory;
$app = AppFactory::create();
$app->setBasePath('/parcial2s/public');

// - Manejo de errores de middleware -
use Psr\Http\Message\ServerRequestInterface;
$app->addRoutingMiddleware();

// Llamo al intermedio entre controladores y rutas
(require_once 'routes.php')($app);
// Llamo al intermedio entre esto y middlewares
(require_once 'middlewares.php')($app);

// Continua manejo del error
$customErrorHandler = function (
    ServerRequestInterface $request,
    Throwable $exception,
    bool $displayErrorDetails,
    bool $logErrors,
    bool $logErrorDetails
) use ($app) {
    $payload = ['error' => $exception->getMessage()];

    $response = $app->getResponseFactory()->createResponse();
    $response->getBody()->write(
        json_encode($payload, JSON_UNESCAPED_UNICODE)
    );
    
    return $response;
};

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);

return $app;
?>