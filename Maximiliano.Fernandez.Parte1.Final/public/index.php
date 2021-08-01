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
//referenciar la clase del modelo
require_once __DIR__ . '/../app/models/Usuario.php';

// y usar un alias para el namespace de la entidad Eloquent ORM
// use \App\Models\Usuario as UsuarioORM;

$app = AppFactory::create();

$container = $app->getContainer();

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();
//cambiar configuracion 
$capsule->addConnection([
  'driver' => 'mysql',
  'host' => 'localhost',
  'database' => 'concesionaria_bd',
  'username' => 'root',
  'password' => '',
  'charset'   => 'utf8',
  'collation' => 'utf8_unicode_ci',
  'prefix'    => '',
]);

$capsule->bootEloquent();
$capsule->setAsGlobal();

$c = $container ;
$c['errorHandler'] = function ($c) {

    return function ($request, $response, $exception) use ($c) {

        return $response->withStatus(500)
            ->withHeader('Content-Type', 'text/html')
            ->write('¡Error no controlado!');
    };
};

$c['notFoundHandler'] = function ($c) {

    return function ($request, $response) use ($c) {

        return $response->withStatus(404)
            ->withHeader('Content-Type', 'text/html')
            ->write('No es una ruta correcta.');
    };
};

$c['notAllowedHandler'] = function ($c) {

    return function ($request, $response, $methods) use ($c) {

        return $response->withStatus(405)
            ->withHeader('Allow', implode(', ', $methods))
            ->withHeader('Content-type', 'text/html')
            ->write('Sólo se puede por: ' . implode(', ', $methods));
    };
};

$c['phpErrorHandler'] = function ($c) {

    return function ($request, $response, $error) use ($c) {

        return $response->withStatus(500)
            ->withHeader('Content-Type', 'text/html')
            ->write('¡Algo está mal con tu PHP!');
    };
};

//************************************************************************************************************// 

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




