<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as ResponseMW;
use Firebase\JWT\JWT; 
require_once "DB_PDO.php";
//require_once "MW.php";

    class Usuario{

        public $correo;
        public $clave;
        public $nombre;
        public $apellido;
        public $perfil;
        public $foto;
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
                $user = MW::TraerCorreoyClave($json);
				$token = array(
					'iat'=>$time,
					 'exp' => $time + 30,
					'aud' => self::$aud,
					'data' => $user,
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
            
            $payload = NULL;
            $datos->mensaje = null;

            try {

                $payload = JWT::decode(
                                        $token,
                                        self::$secret_key,
                                        self::$encrypt
                                    );
				if($payload != null){
					$datos->mensaje = "JWT correcto";
					$datos->status = 200;
					$newResponse = $response->withStatus(200);
					$newResponse->getBody()->write(json_encode($datos));
					return $newResponse->withHeader('Content-Type', 'application/json');
				}
            }catch (Exception $e) { 

                $datos->mensaje = null;
				$datos->status = 403;
				$newResponse = $response->withStatus(403);
				$newResponse->getBody()->write(json_encode($datos));
			
				return $newResponse->withHeader('Content-Type', 'application/json');
            }

        }
        public function AgregarUsuario(Request $request, Response $response, array $args){
            $objJSON = json_decode($request->getParsedBody()['user']);
            $stdclass = new stdClass();
            
            


            $file = $request->getUploadedFiles();//$_FILES
            $destiny = __DIR__ . "/../fotos/";

            $nameBefore = $file['foto']->getClientFilename();
            $extension = explode(".", $nameBefore);
        
            $extension = array_reverse($extension);
            //$finalFile = self::AgregarFoto($file,$idInsert,$objJSON);
            $finalyFile = $objJSON->correo."_1.". $extension[0];
            //$user = new Usuario($objJSON->correo,$objJSON->clave,$objJSON->nombre,$objJSON->apellido,$objJSON->perfil,$finalyFile);
            $idInsert = self::Insertar($objJSON,$finalyFile);
            if($idInsert!= null){
                $file['foto']->moveTo($destiny . $finalyFile);
                $stdclass->exito = true;
                $stdclass->mensaje = "Usuario Agregado";
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

        public static function Insertar($obj ,$file)
        {
            $objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","concesionaria_bd"); 
            $consulta = $objetoAccesoDato->RetornarConsulta('INSERT INTO usuarios(correo,clave,nombre,apellido,perfil,foto) VALUES (:correo,:clave,:nombre,:apellido,:perfil,:foto)');
            $consulta->bindValue(':correo',$obj->correo, PDO::PARAM_STR);
            $consulta->bindValue(':clave', $obj->clave, PDO::PARAM_STR);
            $consulta->bindValue(':nombre',$obj->nombre, PDO::PARAM_STR);
            $consulta->bindValue(':apellido', $obj->apellido, PDO::PARAM_STR);
            $consulta->bindValue(':perfil', $obj->perfil, PDO::PARAM_STR);
            $consulta->bindValue(':foto', $file, PDO::PARAM_STR);
            $consulta->execute();		
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }

        public function TraerTodos(Request $request, Response $response, array $args): Response 
        {
            $stdclass =new stdClass();
            $AllUser = self::TraerTodosDB();
            if($AllUser!=null){
                $stdclass->exito = true;
                $stdclass->mensaje = "Ejecutado Correctamente";
                $stdclass->dato = json_encode($AllUser);
                $stdclass->status = 200;
                $newResponse = $response->withStatus(200, "OK");
                $newResponse->getBody()->write(json_encode($stdclass));
            }else{
                $stdclass->exito = false;
                $stdclass->mensaje = "errror";
                $stdclass->dato = "";
                $stdclass->status = 424;
                $newResponse = $response->withStatus(424, "Error");
                $newResponse->getBody()->write(json_encode($stdclass));
            }
      
            
    
            return $newResponse->withHeader('Content-Type', 'application/json');	
        }


        public static function TraerTodosDB()
        {
            $objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","concesionaria_bd"); 
            $consulta =$objetoAccesoDato->RetornarConsulta('SELECT * FROM usuarios');
            $consulta->execute();			
            return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");		
        }







        


        
    }

?>