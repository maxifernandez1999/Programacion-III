<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Firebase\JWT\JWT; 
require 'DB_PDO.php';
class Usuario{
    public $id;
    public $correo;
    public $clave;
    public $nombre;
    public $apellido;
    public $foto;
    public $id_perfil;
    private static $secret_key = 'ClaveSuperSecreta';
    private static $encrypt = ['HS256'];
    private static $aud = NULL;

    public function AgregarUser(Request $request, Response $response, array $args){

		$datos = $request->getParsedBody();
		$objUser = json_decode($datos['usuario']);
		$stdclass = new stdClass();

        $file = $request->getUploadedFiles();//$_FILES
        $destiny = __DIR__ . "/../fotos/";
        $nameBefore = $file['foto']->getClientFilename();
        $extension = explode(".", $nameBefore);
        $extension = array_reverse($extension);
        $finalyFile = /* $objUser->id. */"1_".$objUser->apellido.'.'. $extension[0];//id???
                
		if(Usuario::AgregarDB($objUser,$finalyFile) != null){
            $file['foto']->moveTo($destiny . $finalyFile);
			$stdclass->exito = true;
			$stdclass->mensaje = "Usuario Agregado";
			$stdclass->status = 200;
			$response->getBody()->write(json_encode($stdclass));
		}else{
			$stdclass->exito = false;
			$stdclass->mensaje = "Error en el agregado del usuario";
			$stdclass->status = 418;
			$response->getBody()->write(json_encode($stdclass));
		}
			
		return $response->withHeader('Content-Type', 'application/json');
	}
    public static function AgregarDB($objUser,$finalyFile){
        $objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","administracion_bd"); 
        $consulta = $objetoAccesoDato->RetornarConsulta('INSERT INTO usuarios (correo,clave,nombre,apellido,foto,id_perfil) VALUES (:correo,:clave,:nombre,:apellido,:foto,:id_perfil)');
        $consulta->bindValue(':correo',$objUser->correo, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $objUser->clave, PDO::PARAM_STR);
        $consulta->bindValue(':nombre', $objUser->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $objUser->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $finalyFile, PDO::PARAM_STR);
        $consulta->bindValue(':id_perfil', $objUser->id_perfil, PDO::PARAM_INT);
        
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();//???
    }
    public function MostrarUsuarios(Request $request, Response $response, array $args): Response {
        $stdclass = new stdClass();
        $AllUser = self::TraerTodosDB();
        if($AllUser!=null){
            $stdclass->exito = true;
            $stdclass->mensaje = "Ejecutado Correctamente";
            $stdclass->dato = json_encode($AllUser);//formato string
            $stdclass->status = 200;
            $response->getBody()->write(json_encode($stdclass));
        }else{
            $stdclass->exito = false;
            $stdclass->mensaje = "Error al traer los usuarios";
            $stdclass->dato = null;
            $stdclass->status = 424;
            $response->getBody()->write(json_encode($stdclass));
        }
        return $response->withHeader('Content-Type', 'application/json');	
    }


    public static function TraerTodosDB(){
        $objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","administracion_bd"); 
        $consulta = $objetoAccesoDato->RetornarConsulta('SELECT * FROM usuarios');
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");		
    }
    public function Login(Request $request, Response $response, array $args){
        $stdclass = new stdClass();
        $json = json_decode($request->getParsedBody()['user']);
        if($json != null){
            $time = time();
            self::$aud = self::Aud();
            $user = self::TraerCorreoyClave($json);
            $token = array(
                'iat'=>$time,
                'exp' => $time + (60)*5,
                'aud' => self::$aud,
                'data' => $user,
                'app'=> "API REST 2021"
            );
            $stdclass->exito = true;
            $stdclass->jwt = JWT::encode($token, self::$secret_key);
            $stdclass->status = 200;
            $response->getBody()->write(json_encode($stdclass));
        }else{
            $stdclass->exito = false;
            $stdclass->jwt = null;
            $stdclass->status = 403;
            $response->getBody()->write(json_encode($stdclass));
        }
        return $response->withHeader('Content-Type', 'application/json');
    }
    public static function TraerCorreoyClave($datosJSON) {
        $correo = $datosJSON->correo;
        $clave = $datosJSON->clave;
        $objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","concesionaria_bd"); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT usuarios.correo,usuarios.nombre,usuarios.apellido,usuarios.foto FROM usuarios WHERE usuarios.correo=:correo AND usuarios.clave=:clave");
        $consulta->bindValue(':correo',$correo, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $clave, PDO::PARAM_STR);
        $consulta->execute();
        $buscado = $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
        return $buscado;		
    }
    public static function Aud() : string{
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
    public function VerificarJWT(Request $request, Response $response, array $args) : object{   
        $token = $request->getHeader("token")[0];
        $datos = new stdClass();
        $payload = NULL;
        try {
            $payload = JWT::decode(
                                    $token,
                                    self::$secret_key,
                                    self::$encrypt
                                );
            $datos->exito = true;
            $datos->status = 200;
            $response->getBody()->write(json_encode($datos));
            return $response->withHeader('Content-Type', 'application/json');
        }catch (Exception $e) { 
            $datos->exito = false;
            $datos->status = 403;
            $response->getBody()->write(json_encode($datos));
            return $response->withHeader('Content-Type', 'application/json');
        }

    }
    public function EliminarUsuario(Request $request, Response $response, array $args){
		$id_usuario = json_decode($request->getBody())->id_usuario;
		$token = $request->getHeader("token")[0];
		$datos = new stdClass();
		try {
			$payload = JWT::decode(
									$token,
									self::$secret_key,
									self::$encrypt
								);
			if($id_usuario != null){
                self::Eliminar($id_usuario);
                $datos->exito = true;
                $datos->mensaje = "Usuario Eliminado";
                $datos->status = 200;
                $response->getBody()->write(json_encode($datos));
				return $response->withHeader('Content-Type', 'application/json');
            }else{
				$datos->exito = false;
				$datos->mensaje = "No se especifica que id desea eliminar";
				$datos->status = 418;
				$response->getBody()->write(json_encode($datos));
				return $response->withHeader('Content-Type', 'application/json');
			}
		}catch (Exception $e) { 

			$datos->mensaje = "jwt invalido";
			$datos->status = 418;
			$datos->exito = false;
			$response->getBody()->write(json_encode($datos));
		
			return $response->withHeader('Content-Type', 'application/json');
		}	
	}

	public static function Eliminar($idEliminar){
		$objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","administracion_bd"); 
		$consulta = $objetoAccesoDato->RetornarConsulta('DELETE FROM usuarios WHERE id = :id');
		$consulta->bindValue(':id', $idEliminar, PDO::PARAM_INT);
			
		return $consulta->execute();				
	}
    public static function TraerUnoDB($id){
        $objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","administracion_bd"); 
        $consulta = $objetoAccesoDato->RetornarConsulta('SELECT * FROM usuarios WHERE id = :id');
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");		
    }
    public function ModificarUsuario(Request $request, Response $response, array $args){
		$token = $request->getHeader("token")[0];
        $usuario = json_decode($request->getParsedBody()['usuario']);
        
        $file = $request->getUploadedFiles();//$_FILES
        $destiny = __DIR__ . "/../fotos/";
        $nameBefore = $file['foto']->getClientFilename();
        $extension = explode(".", $nameBefore);
        $extension = array_reverse($extension);
        $newPathFoto = $usuario->id."_".$usuario->apellido.'.'.$extension[0];
        $fotoAnterior = self::TraerUnoDB($usuario->id)[0]->foto;
		$datos = new stdClass();
		try {
			$payload = JWT::decode(
									$token,
									self::$secret_key,
									self::$encrypt
								);
			if($usuario != null){
                if(file_exists("/../fotos/".$fotoAnterior)){
                    unlink("/../fotos/".$fotoAnterior);
                }
                $file['foto']->moveTo($destiny . $newPathFoto);
                self::Modificar($usuario,$newPathFoto);
                $datos->exito = true;
                $datos->mensaje = "Usuario Modificado";
                $datos->status = 200;
                $response->getBody()->write(json_encode($datos));
				return $response->withHeader('Content-Type', 'application/json');
            }else{
				$datos->exito = false;
				$datos->mensaje = "No se especifica que id desea modificar";
				$datos->status = 418;
				$response->getBody()->write(json_encode($datos));
				return $response->withHeader('Content-Type', 'application/json');
			}
		}catch (Exception $e) { 

			$datos->mensaje = "jwt invalido";
			$datos->status = 418;
			$datos->exito = false;
			$response->getBody()->write(json_encode($datos));
		
			return $response->withHeader('Content-Type', 'application/json');
		}	
	}

	public static function Modificar($datosModificar,$newPathFoto){
		$objDatos = DB_PDO::InstanciarObjetoPDO("localhost","root","","administracion_bd");
		 $consulta = $objDatos->RetornarConsulta("UPDATE usuarios SET correo=:correo,clave=:clave,nombre=:nombre,apellido=:apellido,foto=:foto,id_perfil=:id_perfil WHERE usuarios.id = :id");

		 $consulta->bindValue(':correo',$datosModificar->correo);
		 $consulta->bindValue(':clave',$datosModificar->clave);
         $consulta->bindValue(':nombre',$datosModificar->nombre);
		 $consulta->bindValue(':apellido',$datosModificar->apellido);
         $consulta->bindValue(':id_perfil',$datosModificar->id_perfil);
         $consulta->bindValue(':foto',$newPathFoto);
		 $consulta->bindValue(':id',$datosModificar->id);

		 return $consulta->execute();				
	}
}