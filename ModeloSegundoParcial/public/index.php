<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
Crear un apiRest con las siguientes funcionalidades:
POST → ruta [login]:
Se envían el correo y la clave (parámetro obj_json) a la ruta login por
método POST.
Se invocará al método de instancia VerificarUsuario de la clase
Verificadora.
Si el usuario existe en la base de datos, se creará un JWT (método de
clase CrearJWT, de la clase Autentificadora) con todos los datos del
usuario y 5 minutos de validez.
Se retornará un JSON({jwt} y status 200).
Si el usuario no existe en la base de datos, retornará el jwt nulo y el
status 403.


$app->post('/login[/]', function (Request $request, Response $response, array $args) {
    $datos = $request->getParsedBody();
    $correo = $datos['correo'];
    $clave = $datos['clave'];
    $ahora = time();
  
  //PARAMETROS DEL PAYLOAD -- https://tools.ietf.org/html/rfc7519#section-4.1 --
  //SE PUEDEN AGREGAR LOS PROPIOS, EJ. 'app'=> "API REST 2021"       
  $payload = array(
      'iat' => $ahora,            //CUANDO SE CREO EL JWT (OPCIONAL)
      'exp' => $ahora + (30),     //INDICA EL TIEMPO DE VENCIMIENTO DEL JWT (OPCIONAL)
      'data' => $datos,           //DATOS DEL JWT
      'app' => "API REST 2021"    //INFO DE LA APLICACION (PROPIO)
  );
    
  //CODIFICO A JWT (PAYLOAD, CLAVE, ALGORITMO DE CODIFICACION)
  $token = JWT::encode($payload, "miClaveSecreta", "HS256");

  $newResponse = $response->withStatus(200, "Éxito!!! JSON enviado.");
  
  //GENERO EL JSON A PARTIR DEL ARRAY.
  $newResponse->getBody()->write(json_encode($token));

  //INDICO EL TIPO DE CONTENIDO QUE SE RETORNARÁ (EN EL HEADER).
  return $newResponse->withHeader('Content-Type', 'application/json');
});

// $app->get('/hello/{name}/{apellido}', function (Request $request, Response $response, array $args) {
//     $name = $args['name'];
//     $apellido = $args['apellido'];
//     $response->getBody()->write("Hello, ". $name." ".$apellido);
//     return $response;
// });

$app->run();
