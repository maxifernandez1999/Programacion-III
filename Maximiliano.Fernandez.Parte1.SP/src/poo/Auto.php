<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once "DB_PDO.php";

use Firebase\JWT\JWT; 
class Auto
{
	public $color;
	public $marca;
	public $precio;
	public $modelo;
    private static $secret_key = 'ClaveSuperSecreta';
    private static $encrypt = ['HS256'];
    private static $aud = NULL;


	
    
        public function CrearJWT(Request $request, Response $response, array $args)
        {
			$stdclass = new stdClass();
			$json = json_decode($request->getParsedBody()['user']);
			if($json != null){
				$time = time();
				self::$aud = self::Aud();
	
				$token = array(
					'iat'=>$time,
					 'exp' => $time + (60)*15,
					'aud' => self::$aud,
					'data' => $json->correo,//todos los datos de user
					'app'=> "API REST 2021"
				);
				$stdclass->exito = true;
				$stdclass->jwt = JWT::encode($token, self::$secret_key);
				$stdclass->status = 200;
				$newResponse = $response->withStatus(200);
				$newResponse->getBody()->write(json_encode($stdclass));
			}else{
				$stdclass->exito = false;
				$stdclass->jwt = null;
				$stdclass->status = 403;
				$newResponse = $response->withStatus(403);
				$newResponse->getBody()->write(json_encode($stdclass));
			}
			return $newResponse->withHeader('Content-Type', 'application/json');
        }

		public static function Aud() : string
        {
            $aud = new stdClass();
            $aud->ip_visitante = "";

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $aud->ip_visitante = $_SERVER['HTTP_CLIENT_IP'];
            } 
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $aud->ip_visitante = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $aud->ip_visitante = $_SERVER['REMOTE_ADDR'];//La dirección IP desde la cual está viendo la página actual el usuario.
            }
            
            $aud->user_agent = @$_SERVER['HTTP_USER_AGENT'];
            $aud->host_name = gethostname();
            
            return json_encode($aud);//sha1($aud);
        }

		public function ObtenerPayLoad(Request $request, Response $response, array $args) : object
        {   
			$token = $request->getHeader("token")[0];
            $datos = new stdClass();
            
            $datos->payload = NULL;
            $datos->mensaje = "";

            try {

                $datos->payload = JWT::decode(
                                                $token,
                                                self::$secret_key,
                                                self::$encrypt
                                            );
				if($datos->payload != null){
					$datos->mensaje = "Todo ok";
					$datos->status = 200;
					$newResponse = $response->withStatus(200);
					$newResponse->getBody()->write(json_encode($datos));
					return $newResponse->withHeader('Content-Type', 'application/json');
				}
            }catch (Exception $e) { 

                $datos->mensaje = $e->getMessage();
				$datos->status = 403;
				$newResponse = $response->withStatus(403);
				$newResponse->getBody()->write(json_encode($datos));
			
				return $newResponse->withHeader('Content-Type', 'application/json');
            }

        }
//*********************************************************************************************//
/* IMPLEMENTO LAS FUNCIONES PARA SLIM */
//*********************************************************************************************//

	public function AgregarAuto(Request $request, Response $response, array $args){
		$datosJSON = $request->getParsedBody();
		$objJSON = json_decode($datosJSON['auto']);
		$stdclass =new stdClass();
		if(Auto::AgregarDB($objJSON) != null){

			$stdclass->exito = true;
			$stdclass->mensaje = "Auto Agregado";
			$stdclass->exito = 200;
			$newResponse = $response->withStatus(200);
			$newResponse->getBody()->write(json_encode($stdclass));
		}else{
			$stdclass->exito = false;
			$stdclass->mensaje = "Error Agregado";
			$stdclass->exito = 418;
			$newResponse = $response->withStatus(418);
			$newResponse->getBody()->write(json_encode($stdclass));
		}
			
		return $newResponse->withHeader('Content-Type', 'application/json');
	}
	public static function AgregarDB($objJSON)
		{
			$objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","concesionaria_bd"); 
			$consulta = $objetoAccesoDato->RetornarConsulta('INSERT INTO autos (color,marca,precio,modelo) VALUES (:color,:marca,:precio,:modelo)');
			$consulta->bindValue(':color',$objJSON->color, PDO::PARAM_STR);
			$consulta->bindValue(':marca', $objJSON->marca, PDO::PARAM_STR);
			$consulta->bindValue(':precio', $objJSON->precio, PDO::PARAM_INT);
			$consulta->bindValue(':modelo', $objJSON->modelo, PDO::PARAM_STR);
			
			$consulta->execute();		
			return $objetoAccesoDato->RetornarUltimoIdInsertado();//???
		}
	public function TraerTodos(Request $request, Response $response, array $args): Response 
	{
		$stdclass =new stdClass();
		$AllAutos = self::TraerTodosDB();
            if($AllAutos!=null){
                $stdclass->exito = true;
                $stdclass->mensaje = "autos";
                $stdclass->datos = json_encode($AllAutos);
                $stdclass->status = 200;
                $newResponse = $response->withStatus(200, "OK");
                $newResponse->getBody()->write(json_encode($stdclass));
            }else{
                $stdclass->exito = false;
                $stdclass->mensaje = "Error";
                $stdclass->datos = "";
                $stdclass->exito = 424;
                $newResponse = $response->withStatus(424, "Error");
                $newResponse->getBody()->write(json_encode($stdclass));
            }
      
            
    
            return $newResponse->withHeader('Content-Type', 'application/json');	
	}

	public static function TraerTodosDB()
	{
		$objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","concesionaria_bd"); 
		$consulta =$objetoAccesoDato->RetornarConsulta('SELECT * FROM autos');
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "Auto");		
	}
	//////////////

	

}