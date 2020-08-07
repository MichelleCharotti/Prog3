<?php

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
// use App\Utils\Authenticator;
// use App\Utils\ResponseParser;
use App\Utils\RtaJsend;
use \Firebase\JWT\JWT;

class TokenValidateMiddleware1
{    
    public function __invoke(Request $request, RequestHandler $handler): Response{   

        $response = $handler->handle($request);
        $existingContent = (string) $response->getBody();
        $err = RtaJsend::JsendResponse(false, 'No tiene permisos para realizar la operación');

        $response = new Response();

        try {
            $token = $request->getheaders()['token'][0] ?? null;
            $user = null;

            if(isset($token)) $user = JWT::decode($token,'Password', array('HS256'))[0];

            $response->getBody()->write(isset($user) ? $existingContent : $err);
        } catch (Exception $e) {
            $response->getBody()->write($err);
        }

        return $response;        
    }
}
