<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as ResponseMW;
use Firebase\JWT\JWT; 
class MW{
    private static $secret_key = 'ClaveSuperSecreta';
    private static $encrypt = ['HS256'];
    private static $aud = NULL;
    public function VerificarToken(Request $request,RequestHandler $handler) : ResponseMW{
        $datos = new stdClass();
        $token = isset($request->getHeader("token")[0]) ? $request->getHeader("token")[0] : null;
        $newresponse = new ResponseMW();
        if($token != null){
            try {
                    $payload = JWT::decode(
                        $token,
                        self::$secret_key,
                        self::$encrypt
                    );
                    $response = $handler->handle($request);
                    return $response;
            }catch (Exception $e) { 
                $datos->mensaje = $e->getMessage();
                $datos->status = 403;
                $newresponse->getBody()->write(json_encode($datos));
                return $newresponse->withHeader('Content-Type', 'application/json');
            }
        }else{
            $datos->mensaje = "no existe el jwt";
            $datos->status = 403;
            $newresponse->getBody()->write(json_encode($datos));
            return $newresponse->withHeader('Content-Type', 'application/json');
        }

    }
}