<?php
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollector;
use \Slim\Routing\RouteCollectorProxy;
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/poo/Usuario.php';
require __DIR__ . '/../src/poo/Perfil.php';
$app = AppFactory::create();

// $app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
//     $name = $args['name'];
//     $response->getBody()->write("Hello, $name");
//     return $response;
// });
$app->post("/login" ,Usuario::class . ':Login');
$app->get("/login" ,Usuario::class . ':VerificarJWT');

$app->post("/usuario" ,Usuario::class . ':AgregarUser');
$app->get("/" ,Usuario::class . ':MostrarUsuarios');

$app->post("/" ,Perfil::class . ':AgregarPerfil');
$app->get('/perfil', Perfil::class . ':MostrarPerfiles');

 
$app->group('/perfiles',function (RouteCollectorProxy $grupo){
    $grupo->delete('/', \Perfil::class . ':EliminarPerfil');
    $grupo->put('/', \Perfil::class . ':ModificarPerfil');
});

$app->group('/usuarios',function (RouteCollectorProxy $grupo){
    $grupo->delete('/', \Usuario::class . ':EliminarUsuario');
    $grupo->put('/', \Usuario::class . ':ModificarUsuario');
});

$app->run();