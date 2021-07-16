<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as ResponseMW;
use Firebase\JWT\JWT; 
use Slim\Views\Twig;
require_once "DB_PDO.php";

class Front{
    public function EjemploFront(Request $request, Response $response, array $args){
        $view = Twig::fromRequest($request);
        return $view->render($response, 'login.php');

    }
}