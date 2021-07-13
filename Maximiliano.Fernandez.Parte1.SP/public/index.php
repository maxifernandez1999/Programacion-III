<?php

use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollector;
use \Slim\Routing\RouteCollectorProxy;
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/poo/Auto.php';
require __DIR__ . '/../src/poo/Usuario.php';
require __DIR__ . '/../src/poo/MW.php';
$app = AppFactory::create();


$app->post('/usuarios',Usuario::class . ':AgregarUsuario');/* ->add(Verificadora::class . ':ValidarParametrosUsuario'); */
// $app->post('/login[/]',Verificadora::class . ':VerificarUsuario')->add(Verificadora::class . ':ValidarParametrosUsuario');

 $app->get("/" ,Usuario::class . ':TraerTodos');

 $app->post("/" ,Auto::class . ':AgregarAuto');

 $app->get("/autos" ,Auto::class . ':TraerTodos');

 $app->post("/login" ,Auto::class . ':CrearJWT')->add(MW::class . ':VerificarBD')->add(MW::class . ':VerificaVacio')->add(MW::class . ':ValidarParametrosUsuario');

 $app->get("/login" ,Auto::class . ':ObtenerPayLoad');
 
 
// $app->group('/json_bd',function (RouteCollectorProxy $grupo){
//     $grupo->get('/', \cd::class . ':TraerTodos');
//     $grupo->get('/{id}', \cd::class . ':TraerUno');
//     $grupo->post('/', \cd::class . ':Agregar')->add(Verificadora::class . ':ValidarParametrosCDAgregar');
//     $grupo->put('/{obj_json}', \cd::class . ':Modificar')->add(Verificadora::class . ':ValidarParametrosCDModificar');
//     $grupo->delete('/{id}', \cd::class . ':Eliminar')->add(Verificadora::class . ':ValidarParametrosCDBorrar');
// })->add(Verificadora::class . ':ChequearJWT');

 $app->run();




// $app->get('/hello/{name}/{apellido}', function (Request $request, Response $response, array $args) {
//     $name = $args['name'];
//     $apellido = $args['apellido'];
//     $response->getBody()->write("Hello, ". $name." ".$apellido);
//     return $response;
// });