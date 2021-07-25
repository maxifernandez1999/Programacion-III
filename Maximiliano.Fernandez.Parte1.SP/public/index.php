<?php

use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollector;
use \Slim\Routing\RouteCollectorProxy;
//necesario para las vistas
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/poo/Auto.php';
require __DIR__ . '/../src/poo/Usuario.php';
require __DIR__ . '/../src/poo/MW.php';
require __DIR__ . '/../src/poo/Front.php'; ///para laboratorio
$app = AppFactory::create();


$app = AppFactory::create();

//SE TIENE QUE AGREGAR EL COMPONENTE TWIG --> composer require slim/twig-view
//SE ESTABLECE EL PATH DE LOS TEMPLATES
$twig = Twig::create('../src/views', ['cache' => false]);
//SE AGREGA EL MIDDLEWARE DE TWIG
$app->add(TwigMiddleware::create($app, $twig));

//************************************************************************************************************//

$app->get('/front-end',Front::class . ':InicioFront');  
$app->get('/loginusuarios',Front::class . ':LoginUsuarios');
$app->get('/principal',Front::class . ':MenuPrincipal');
  
  

$app->post('/usuarios',Usuario::class . ':AgregarUsuario')->add(MW::class . ':VerificarCorreo')->add(MW::class . '::VerificaVacio')->add(MW::class . ':ValidarParametrosUsuario');/* ->add(Verificadora::class . ':ValidarParametrosUsuario'); */
// $app->post('/login[/]',Verificadora::class . ':VerificarUsuario')->add(Verificadora::class . ':ValidarParametrosUsuario');

 $app->get("/" ,Usuario::class . ':TraerTodos');

 $app->post("/" ,Auto::class . ':AgregarAuto')->add(MW::class . ':VerificarPrecioyColor');

 $app->get("/autos" ,Auto::class . ':TraerTodos');

 $app->post("/login" ,Usuario::class . ':CrearJWT')->add(MW::class . ':VerificarBD')->add(MW::class . '::VerificaVacio')->add(MW::class . ':ValidarParametrosUsuario');

 $app->get("/login" ,Usuario::class . ':ObtenerPayLoad');

 $app->delete("/" ,Auto::class . ':EliminarAuto');

 $app->put("/" ,Auto::class . ':ModificarAuto');
 
 
 
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