<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as ResponseMW;

use Slim\Factory\AppFactory;
use \Slim\Routing\RouteCollectorProxy;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();


//*********************************************************************************************//
//EJERCICIO 1:
//AGREGAR EL GRUPO /CREDENCIALES CON LOS VERBOS GET Y POST (MOSTRAR QUE VERBO ES)
//AL GRUPO, AGREGARLE UN MW QUE, DE ACUERDO EL VERBO, VERIFIQUE CREDENCIALES O NO. 
//GET -> NO VERIFICA (INFORMARLO). ACCEDE AL VERBO.
//POST-> VERIFICA; SE ENVIA: NOMBRE Y PERFIL.
//*-SI EL PERFIL ES 'ADMINISTRADOR', MUESTRA EL NOMBRE Y ACCEDE AL VERBO.
//*-SI NO, MUESTRA MENSAJE DE ERROR. NO ACCEDE AL VERBO.
//*********************************************************************************************//

$app->group('/credenciales', function (RouteCollectorProxy $grupo) {

  //EN LA RAIZ DEL GRUPO
  $grupo->get('/', function (Request $request, Response $response, array $args): Response {
    // RETORNA LA RESPUESTA DEL SERVIDOR
    // ESCRIBO EN EL CUERPO
    $response->getBody()->write("-GET- En el raíz del grupo...");
    return $response;

  });

  $grupo->post('/', function (Request $request, Response $response, array $args): Response {
    // RETORNA LA RESPUESTA DEL SERVIDOR
    // ESCRIBO EN EL CUERPO
    $response->getBody()->write("-POST- En el raíz del grupo...");
    return $response;

  });
//SIEMPRE RETORNA UNA RESPUESTA NUEVA INSTANCIADA
})->add(function(Request $request, RequestHandler $handler) : ResponseMW {

  $contenidoAPI = "";

  //EJECUTO ACCIONES ANTES DE INVOCAR AL SIGUIENTE MW
  $antes = 'en MW_MAPA antes del callable <br>';

  if($request->getMethod() === "GET") 
    {
      $respuesta = 'NO necesita creedenciales para GET<br>';
      //FUNCION PARA EJECUTAR EL SIGUIENTE MIDDLEWARE O EN EL CASO DE NO HABER MAS SE EJECUTA EL VERBO
      $response = $handler->handle($request);

      //OBTENGO LO QUE RETORNO LA RESPUESTA DEL VERBO
      $contenidoAPI = $response->getBody();
    }
    if($request->getMethod() === "POST")
    {
      $respuesta = 'Verifico creedenciales<br>';
      //OBTENGO LOS ELEMENTOS OBTENIDOS DEL CUERPO DE LA REQUEST
      //RETORNA UN ARRAY ASOCIATIVO
      $arrayDeParametros = $request->getParsedBody();
      $nombre = $arrayDeParametros['nombre'];
      $perfil = $arrayDeParametros['perfil'];

      if ($perfil == "administrador") {
          $respuesta = "bienvenido";

          //FUNCION PARA EJECUTAR EL SIGUIENTE MIDDLEWARE O EN EL CASO DE NO HABER MAS SE EJECUTA EL VERBO
          $response = $handler->handle($request);

          //OBTENGO LO QUE RETORNO LA RESPUESTA DEL VERBO
          $contenidoAPI = $response->getBody();
      }else{
        $respuesta = "no tiene habilitado el ingreso";
      }
    } 
  
  //EJECUTO ACCIONES DESPUES DE INVOCAR AL SIGUIENTE MW
  $despues = " en MW_MAPA después del callable ";

  //GENERO UNA NUEVA RESPUESTA
  $response = new ResponseMW();

  //PINTO LA RESPUESTA DE LOS METODOS () EL CONTENIDO DE LOS VERBOS DE LA API
  //Y QUE SECEDE DESPUES EN EL MIDDLEWARE
  $response->getBody()->write("{$respuesta} {$contenidoAPI} <br> {$despues}");

  return $response;
});

//*********************************************************************************************//
//EJERCICIO 2:
//AGREGAR EL GRUPO /JSON CON LOS VERBOS GET Y POST. RETORNA UN JSON (MENSAJE, STATUS)
//AL GRUPO, AGREGARLE UN MW QUE, DE ACUERDO EL VERBO, VERIFIQUE CREDENCIALES O NO. 
//GET -> NO VERIFICA. ACCEDE AL VERBO. RETORNA {"API => GET", 200}.
//POST-> VERIFICA; SE ENVIA (JSON): OBJ_JSON, CON NOMBRE Y PERFIL.
//*-SI EL PERFIL ES 'ADMINISTRADOR', ACCEDE AL VERBO. RETORNA {"API => POST", 200}.
//*-SI NO, MUESTRA MENSAJE DE ERROR. NO ACCEDE AL VERBO. {"ERROR. NOMBRE", 403}
//*********************************************************************************************//

$app->group('/json', function (RouteCollectorProxy $grupo) {

  $grupo->get('/', function (Request $request, Response $response, array $args): Response {

    $datos = new stdclass();

    $datos->mensaje = "API => GET";

    $newResponse = $response->withStatus(200);
  
    $newResponse->getBody()->write(json_encode($datos));

    return $newResponse->withHeader('Content-Type', 'application/json');

  });

  $grupo->post('/', function (Request $request, Response $response, array $args): Response {

    $datos = new stdclass();

    $datos->mensaje = "API => POST";

    $newResponse = $response->withStatus(200);
  
    $newResponse->getBody()->write(json_encode($datos));

    return $newResponse->withHeader('Content-Type', 'application/json');

  });

})->add(function(Request $request, RequestHandler $handler) : ResponseMW {

  $contenidoAPI = "";

  //EJECUTO ACCIONES ANTES DE INVOCAR AL SIGUIENTE MW
  $antes = 'en MW_MAPA antes del callable <br>';
  $respuesta = new stdclass();
  if($request->getMethod() === "GET") 
    {
      $response = $handler->handle($request);
      $contenidoAPI = json_decode($response->getBody());
    }
    if($request->getMethod() === "POST")
    {
      $arrayDeParametros = $request->getParsedBody();
      $json = json_decode($arrayDeParametros['obj_json']);
      if ($json->perfil == "administrador") {
        $response = $handler->handle($request);
        $contenidoAPI = json_decode($response->getBody());
      }else{
        $contenidoAPI->mensaje = "Error. $json->nombre";
        $status = 403;
      }
    } 
  
  //EJECUTO ACCIONES DESPUES DE INVOCAR AL SIGUIENTE MW
  $despues = " en MW_MAPA después del callable ";

  //GENERO UNA NUEVA RESPUESTA
  $response = new ResponseMW($status);

  $response->getBody()->write(json_encode($contenidoAPI));

  return $response->withHeader('Content-Type', 'application/json');
});

//*********************************************************************************************//
//EJERCICIO 3:
//AGREGAR EL GRUPO /JSON_BD CON LOS VERBOS GET Y POST (A NIVEL RAIZ). 
//GET Y POST -> TRAEN (EN FORMATO JSON) TODOS LOS USUARIO DE LA BASE DE DATOS. USUARIO->TRAERTODOS().
//AGREGAR UN MW, SOLO PARA POST, QUE VERIFIQUE AL USUARIO (CORREO Y CLAVE).
//POST-> VERIFICADORA->VERIFICARUSUARIO(); SE ENVIA(JSON): OBJ_JSON, CON CORREO Y CLAVE.
//*-SI EXISTE EL USUARIO EN LA BASE DE DATOS (VERIFICADORA::EXISTEUSUARIO($OBJ)), ACCEDE AL VERBO.
//*-SI NO, MUESTRA MENSAJE DE ERROR. NO ACCEDE AL VERBO. {"ERROR.", 403}
//*********************************************************************************************//

require_once __DIR__ . '/../src/poo/accesodatos.php';
require_once __DIR__ . '/../src/poo/usuario.php';
require_once __DIR__ . '/../src/poo/verificadora.php';

$app->group('/json_bd', function (RouteCollectorProxy $grupo) {

  $grupo->get('/', \Usuario::class . ':TraerTodos'); 

  $grupo->post('/', \Usuario::class . ':TraerTodos')->add(\Verificadora::class . ":VerificarUsuario");  

});


//*********************************************************************************************//
//EJERCICIO 4:
//AL EJERCICIO ANTERIOR:
//AGREGAR, A NIVEL DE GRUPO, UN MW QUE VERIFIQUE:
//GET-> ACCEDE AL VERBO. (NO HACE NADA NUEVO).
//POST-> VERIFICA SI FUE ENVIADO EL PARAMETRO 'OBJ_JSON'.
//*-SI NO, MUESTRA MENSAJE DE ERROR. NO ACCEDE AL VERBO. {"ERROR.", 403}
//*-SI FUE ENVIADO, VERIFICA SI EXISTEN LOS PARAMETROS 'CORREO' Y 'CLAVE'.
//*-*-SI ALGUNO NO EXISTE (O LOS DOS), MUESTRA MENSAJE DE ERROR. NO ACCEDE AL VERBO. {"ERROR.", 403}
//*-SI EXISTEN, ACCEDE AL VERBO.
//*********************************************************************************************//




//CORRE LA APLICACIÓN.
$app->run();