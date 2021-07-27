<?php
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollector;
use \Slim\Routing\RouteCollectorProxy;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/poo/Usuario.php';
require __DIR__ . '/../src/poo/Perfil.php';
require __DIR__ . '/../src/poo/MW.php';
require __DIR__ . '/../src/poo/Front.php'; ///para laboratorio

$app = AppFactory::create();

// $app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
//     $name = $args['name'];
//     $response->getBody()->write("Hello, $name");
//     return $response;
// });

//SE TIENE QUE AGREGAR EL COMPONENTE TWIG --> composer require slim/twig-view
//SE ESTABLECE EL PATH DE LOS TEMPLATES
$twig = Twig::create('../src/views', ['cache' => false]);
//SE AGREGA EL MIDDLEWARE DE TWIG
$app->add(TwigMiddleware::create($app, $twig));



//front end
$app->get('/front-end',Front::class . ':LoginFrontEnd');  
$app->get('/registrousuarios',Front::class . ':RegistroUsuarios');
$app->get('/principal',Front::class . ':Principal');  



$app->post("/login" ,Usuario::class . ':Login');
$app->get("/login" ,Usuario::class . ':VerificarJWT');

$app->post("/usuario" ,Usuario::class . ':AgregarUser')/*->add(MW::class . ':VerificarToken') */;
$app->get("/" ,Usuario::class . ':MostrarUsuarios');

$app->post("/" ,Perfil::class . ':AgregarPerfil')/* ->add(MW::class . ':VerificarToken') */;
$app->get('/perfil', Perfil::class . ':MostrarPerfiles');

 
$app->group('/perfiles',function (RouteCollectorProxy $grupo){
    $grupo->delete('/', \Perfil::class . ':EliminarPerfil');
    $grupo->put('/', \Perfil::class . ':ModificarPerfil');
})->add(MW::class . ':VerificarToken');

$app->group('/usuarios',function (RouteCollectorProxy $grupo){
    $grupo->delete('/', \Usuario::class . ':EliminarUsuario');
    $grupo->post('/', \Usuario::class . ':ModificarUsuario');
})->add(MW::class . ':VerificarToken');

$app->run();