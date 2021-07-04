<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as ResponseMW;
use Slim\Factory\AppFactory;

require __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../Poo/Usuario.php';
use \Slim\Routing\RouteCollectorProxy;
$app = AppFactory::create();

//EJERCICIO 1
$app->group('/credenciales',function(RouteCollectorProxy $grupo){
    $grupo->get('/',function(Request $request, Response $response, array $args):Response{
        $response->getBody()->write("API => GET");
        return $response;
    });
    $grupo->post('/',function(Request $request, Response $response, array $args):Response{
        $response->getBody()->write("API => POST");
        return $response;
    });

})->add(function(Request $request, RequestHandler $handler) : ResponseMW {
    $contenidoAPI = "";
    if($request->getMethod() === "GET") 
    {
      $respuesta = 'NO necesito credenciales para GET';
      $response = $handler->handle($request);
      $contenidoAPI = (string) $response->getBody();
    }
    else if($request->getMethod() === "POST")
    {
        $respuesta = 'Verifico creedenciales<br>';
        $arrayParams = $request->getParsedBody();
		$nombre = $arrayParams['nombre'];
        $perfil = $arrayParams['perfil'];

        if($perfil == 'administrador'){
            $respuesta = "BIENVENIDO".$nombre;
            $response = $handler->handle($request);
            $contenidoAPI = (string) $response->getBody();
        }else{
            $respuesta = "No tiene habilitado el ingreso";
        }
    }

    $response = new ResponseMW();

    $response->getBody()->write("{$respuesta} <br> {$contenidoAPI}");

    return $response;
});

//EJERCICIO 2 
$app->group('/json',function(RouteCollectorProxy $grupo){
    $grupo->get('/',function(Request $request, Response $response, array $args):Response{
        $stdClass = new stdClass();
        $stdClass->mensaje = "API => GET";
        $newResponse = $response->withStatus(200);
        $newResponse->getBody()->write(json_encode($stdClass));
        return $newResponse->withHeader('Content-Type', 'application/json');
    });
    $grupo->post('/',function(Request $request, Response $response, array $args):Response{
        $stdClass = new stdClass();
        $stdClass->mensaje = "API => POST";
        //PARA CAMBIAR EL ESTADO DE LA PETICION
        $newResponse = $response->withStatus(200);
        $newResponse->getBody()->write(json_encode($stdClass));

        ///NECESARIO PARA ENVIAR JSON
        return $newResponse->withHeader('Content-Type', 'application/json');
    });

})->add(function(Request $request, RequestHandler $handler) : ResponseMW {
    $contenidoAPI = "";
    $status = 200;
    if($request->getMethod() === "GET") 
    {
        //LLAMO AL VERBO O AL SIGUIENTE MIDDLEWARE
        $response = $handler->handle($request);
        $contenidoAPI = json_decode($response->getBody());
    }
    if($request->getMethod() === "POST")
    {
        $objJSON = $request->getParsedBody();
		$json = $objJSON['obj_json'];
        $jsonDecode = json_decode($json);
    
        if($jsonDecode->perfil == 'administrador'){
            $response = $handler->handle($request);
            $contenidoAPI = json_decode($response->getBody());
        }else{
            $contenidoAPI->mensaje = "Error". $json->nombre;
            $status = 403;
        }
    }

    $newResponse = new ResponseMW($status);

    $newResponse->getBody()->write(json_encode($contenidoAPI));

    return $newResponse->withHeader('Content-Type', 'application/json');
});

///EJERCICIO 3

$app->group('/json_bd',function(RouteCollectorProxy $grupo){
    $grupo->get('/',Usuario::class . ':TraerTodos');
    $grupo->post('/',Usuario::class . ':TraerTodos');

});

// $app->group('/usuario', function (RouteCollectorProxy $grupo) {   

//     $grupo->get('/', Usuario::class . ':GetAll');
//     $grupo->get('/{id}', \Usuario::class . ':GetOne');
//     $grupo->post('/', \Usuario::class . ':Add');
//     $grupo->put('/{cadenaJson}', \Usuario::class . ':Modify');
//     $grupo->delete('/{id}', \Usuario::class . ':Delete');

// });


// CORRE LA APLICACIÓN.
$app->run();