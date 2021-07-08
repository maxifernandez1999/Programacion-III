<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as ResponseMW;
 
require_once "DB_PDO.php";
require_once "Autentificadora.php";

    class Verificadora{
        public function VerificarUsuario(Request $request, Response $response, array $args){
            $existe = false;
            $datosJSON = $request->getParsedBody();
            $objJSON = json_decode($datosJSON['obj_json']);
            $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","databaseUsuarios");
            $consulta = $objPDO->RetornarConsulta("SELECT * FROM usuarios");
            $consulta->execute();
            while($obj = $consulta->fetchObject()){
                if($objJSON->correo == $obj->correo && $objJSON->clave == $obj->clave){
                    $token = Autentificadora::CrearJWT($objJSON);
                    $newResponse = $response->withStatus(200);
                    $newResponse->getBody()->write(json_encode($token));
                    $existe = true;
                    break;
                }
            }
            if($existe == false){
                $newResponse = $response->withStatus(403);
                $newResponse->getBody()->write(json_encode(null));
            }
            return $newResponse->withHeader('Content-Type', 'application/json');
        }

        public function ValidarParametrosUsuario(Request $request, RequestHandler $handler) : ResponseMW{
            $stdClass = new stdClass();
            $existe = false;
            $datosJSON = $request->getParsedBody();
            $existe = $datosJSON != null ? true : false;
            $response = new ResponseMW();
            if($existe == true){
                $objJSON = json_decode($datosJSON['obj_json']);
                if($objJSON->correo === null){
                    $stdClass->mensaje = "no existe el correo";
                    $stdClass->status = 403;
                    $response->getBody()->write(json_encode($stdClass));
                    return $response->withHeader('Content-Type', 'application/json');
                }
                if($objJSON->clave === null){
                    $stdClass->mensaje = "no existe la clave";
                    $stdClass->status = 403;
                    $response->getBody()->write(json_encode($stdClass));
                    return $response->withHeader('Content-Type', 'application/json');
                }else{
                    $response = $handler->handle($request);
                    $contenidoAPI = (string) $response->getBody();
                    $newResponse = $response->withStatus(200);
                    //$newResponse->getBody()->write(json_encode($contenidoAPI));
                    return $newResponse->withHeader('Content-Type', 'application/json');
                }
            }else{
                $stdClass->mensaje = "no existe el obj_json";  
                $stdClass->status = 403;
                $response->getBody()->write(json_encode($stdClass));
                return $response->withHeader('Content-Type', 'application/json');
            }
            
            
            // return $newResponse->withHeader('Content-Type', 'application/json');
        }

        
        function ObtenerDataJWT(Request $request, Response $response, array $args) : Response {
  
            $token = $request->getHeader("token")[0];

            $obj_rta = Autentificadora::ObtenerPayLoad($token);

            $status = $obj_rta->exito ? 200 : 403;

            $newResponse = $response->withStatus($status);

            $newResponse->getBody()->write(json_encode($obj_rta->payload));
    
            return $newResponse->withHeader('Content-Type', 'application/json');
          
        }
        function ChequearJWT(Request $request, RequestHandler $handler) : ResponseMW {
            $datos = new stdClass();
            $datos->exito = FALSE;
            $datos->mensaje = "";
            $token = $request->getHeader("token")[0];

            try 
            {
                if( ! isset($token))
                {
                    $datos->mensaje = "";
                }
                else
                {          
                    $obj_rta = Autentificadora::ObtenerPayLoad($token);

                    if($obj_rta->payload->aud !== Autentificadora::Aud())
                    {
                        $obj_rta->mensaje = null;
                    }
                    else
                    {
                        $datos->exito = TRUE;
                        $response = $handler->handle($request);
                        $contenidoAPI = (string) $response->getBody();
                        $datos->mensaje = $contenidoAPI;
                        
                    } 
                }          
            } 
            catch (Exception $e) 
            {
                $datos->mensaje = "Token inválido!!! - " . $e->getMessage();
            }
            $newResponse = new ResponseMW();
            $newResponse->getBody()->write(json_encode($datos));
            return $newResponse->withHeader('Content-Type', 'application/json');
        }
        
    }

?>