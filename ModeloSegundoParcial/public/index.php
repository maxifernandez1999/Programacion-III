<?php

use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollector;
use \Slim\Routing\RouteCollectorProxy;
require __DIR__ . '/../vendor/autoload.php';
// require __DIR__ . '/../clases/Autentificadora.php';
require __DIR__ . '/../clases/Verificadora.php';
require __DIR__ . '/../clases/Cd.php';
$app = AppFactory::create();



$app->post('/login[/]',Verificadora::class . ':VerificarUsuario')->add(Verificadora::class . ':ValidarParametrosUsuario');

$app->get("/login/test" ,Verificadora::class . ':ObtenerDataJWT')->add(Verificadora::class . ':ChequearJWT');

$app->group('/json_bd',function (RouteCollectorProxy $grupo){
    $grupo->get('/', \cd::class . ':TraerTodos');
    $grupo->get('/{id}', \cd::class . ':TraerUno');
    $grupo->post('/', \cd::class . ':Agregar')->add(Verificadora::class . ':ValidarParametrosCDAgregar');
    $grupo->put('/{obj_json}', \cd::class . ':Modificar')->add(Verificadora::class . ':ValidarParametrosCDModificar');
    $grupo->delete('/{id}', \cd::class . ':Eliminar')->add(Verificadora::class . ':ValidarParametrosCDBorrar');
})->add(Verificadora::class . ':ChequearJWT');

$app->run();




// $app->get('/hello/{name}/{apellido}', function (Request $request, Response $response, array $args) {
//     $name = $args['name'];
//     $apellido = $args['apellido'];
//     $response->getBody()->write("Hello, ". $name." ".$apellido);
//     return $response;
// });