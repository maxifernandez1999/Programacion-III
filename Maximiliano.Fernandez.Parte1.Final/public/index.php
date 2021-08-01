<?php

use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollector;
use \Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
//necesario para las vistas
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/poo/Auto.php';
require __DIR__ . '/../src/poo/Usuario.php';
require __DIR__ . '/../src/poo/MW.php';


$app = AppFactory::create();

  

$app->post('/usuarios',Usuario::class . ':AgregarUsuario')->add(MW::class . ':VerificarCorreo')->add(MW::class . '::VerificarVacio')->add(MW::class . ':ValidarUsuarioSeteado');
// // $app->post('/login[/]',Verificadora::class . ':VerificarUsuario')->add(Verificadora::class . ':ValidarParametrosUsuario');

 $app->get("/" ,Usuario::class . ':TraerUsuarios');

 $app->post("/" ,Auto::class . ':AgregarAuto')->add(MW::class . ':VerificarPrecioyColor');

 $app->get("/autos" ,Auto::class . ':TraerAutos');

 $app->post("/login" ,Usuario::class . ':Login')->add(MW::class . ':VerificarBD')->add(MW::class . '::VerificarVacio')->add(MW::class . ':ValidarUsuarioSeteado');

 $app->get("/login" ,Usuario::class . ':VerificarToken');

 $app->delete("/" ,Auto::class . ':EliminarAuto');

 $app->put("/" ,Auto::class . ':ModificarAuto');
 
 
 

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, ". $name);
    return $response;
});
 $app->run();




