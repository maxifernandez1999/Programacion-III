<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as ResponseMW;

require_once "DB_PDO.php";
require_once "Usuario.php";
    class MW{
        public function ValidarParametrosUsuario(Request $request, RequestHandler $handler) : ResponseMW{
            
            $datosJSON = isset($request->getParsedBody()['user']) ? $request->getParsedBody()['user'] : null;
            $response = new ResponseMW();
            $stdClass = new stdClass();
            if($datosJSON != null){
                
                $objJSON = json_decode($datosJSON);
                if(!isset($objJSON->correo) && !isset($objJSON->clave)){
                    $stdClass->mensaje = "no existe el correo y la clave";
                    $stdClass->status = 403;
                    $response->getBody()->write(json_encode($stdClass));
                    return $response->withHeader('Content-Type', 'application/json');
                }
                if(!isset($objJSON->correo)){
                    $stdClass->mensaje = "no existe el correo";
                    $stdClass->status = 403;
                    $response->getBody()->write(json_encode($stdClass));
                    return $response->withHeader('Content-Type', 'application/json');
                }
                if(!isset($objJSON->clave)){
                    $stdClass->mensaje = "no existe la clave";
                    $stdClass->status = 403;
                    $response->getBody()->write(json_encode($stdClass));
                    return $response->withHeader('Content-Type', 'application/json');
                }
                    $response = $handler->handle($request);
                    return $response;
                    // $contenidoAPI = (string) $response->getBody();
                    // $stdClass->mensaje = $contenidoAPI;
                    // $stdClass->status = 200;
                    // $newResponse = $response->withStatus(200);
                    // $newResponse->getBody()->write(json_encode($contenidoAPI));
                    // return $newResponse->withHeader('Content-Type', 'application/json');
                
            }else{
                $stdClass->mensaje = "no existe el JSON";  
                $stdClass->status = 403;
                $response->getBody()->write(json_encode($stdClass));
                return $response->withHeader('Content-Type', 'application/json');
            }
            
            
            // return $newResponse->withHeader('Content-Type', 'application/json');
        }

        public function VerificaVacio(Request $request, RequestHandler $handler) : ResponseMW{
            $stdClass = new stdClass();
            $datosJSON = $request->getParsedBody()['user'];
            $response = new ResponseMW();
            if($datosJSON != null){
                $objJSON = json_decode($datosJSON);
                if($objJSON->correo === "" && $objJSON->clave === ""){
                    $stdClass->mensaje = "Correo y Clave Vacios";
                    $stdClass->status = 409;
                    $response->getBody()->write(json_encode($stdClass));
                    return $response->withHeader('Content-Type', 'application/json');
                }
                if($objJSON->correo === ""){
                    $stdClass->mensaje = "Correo Vacio";
                    $stdClass->status = 409;
                    $response->getBody()->write(json_encode($stdClass));
                    return $response->withHeader('Content-Type', 'application/json');
                }
                if($objJSON->clave === ""){
                    $stdClass->mensaje = "Clave Vacia";
                    $stdClass->status = 409;
                    $response->getBody()->write(json_encode($stdClass));
                    return $response->withHeader('Content-Type', 'application/json');
                }
                    $response = $handler->handle($request);
                    return $response;
                    // $contenidoAPI = (string) $response->getBody();
                    // $stdClass->mensaje = $contenidoAPI;
                    // $stdClass->status = 200;
                    // $newResponse = $response->withStatus(200);
                    // $newResponse->getBody()->write(json_encode($stdClass));
                    // return $newResponse->withHeader('Content-Type', 'application/json');
                
            }else{
                $stdClass->mensaje = "no existe el obj_json";  
                $stdClass->status = 403;
                $response->getBody()->write(json_encode($stdClass));
                return $response->withHeader('Content-Type', 'application/json');
            }

        }

        	public function VerificarBD(Request $request,RequestHandler $handler) : ResponseMW
            {
                $stdClass = new stdClass();
                $newResponse = new ResponseMW();
                $datosJSON = json_decode($request->getParsedBody()['user']);
                $User = self::TraerUnoDB($datosJSON);
                if($User != null){
                    $response = $handler->handle($request);
                    return $response;
                    // $stdClass->mensaje = "Datos Correctos";
                    // $stdClass->status = 200;
                    // $newResponse->getBody()->write(json_encode($stdClass));
                    // return $newResponse->withHeader('Content-Type', 'application/json');
                }else{
                    $stdClass->mensaje = "No existe la clave y el correo en la Base de Datos";
                    $stdClass->status = 403;
                    $newResponse->getBody()->write(json_encode($stdClass));
                    return $newResponse->withHeader('Content-Type', 'application/json');
                }

            }

    	public static function TraerUnoDB($datosJSON) 
        {
            $correo = $datosJSON->correo;
            $clave = $datosJSON->clave;
            $objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","concesionaria_bd"); 
            $consulta =$objetoAccesoDato->RetornarConsulta("SELECT usuarios.correo,usuarios.clave,usuarios.nombre,usuarios.apellido,usuarios.perfil,usuarios.foto FROM usuarios WHERE usuarios.correo=:correo AND usuarios.clave=:clave");
            $consulta->bindValue(':correo',$correo, PDO::PARAM_STR);
            $consulta->bindValue(':clave', $clave, PDO::PARAM_STR);
            $consulta->execute();
            $buscado = $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
            return $buscado;		
        }
    }

?>