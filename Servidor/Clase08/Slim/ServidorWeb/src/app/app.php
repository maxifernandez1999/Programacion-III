<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../Poo/Usuario.php';
use \Slim\Routing\RouteCollectorProxy;
$app = AppFactory::create();


$app->group('/usuario', function (RouteCollectorProxy $grupo) {   

    $grupo->get('/', Usuario::class . ':GetAll');
    $grupo->get('/{id}', \Usuario::class . ':GetOne');
    $grupo->post('/', \Usuario::class . ':Add');
    $grupo->put('/{cadenaJson}', \Usuario::class . ':Modify');
    $grupo->delete('/{id}', \Usuario::class . ':Delete');

});


//CORRE LA APLICACIÓN.
$app->run();