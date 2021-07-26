<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Firebase\JWT\JWT; 
class Perfil{
    private static $secret_key = 'ClaveSuperSecreta';
    private static $encrypt = ['HS256'];
    private static $aud = NULL;
    public function AgregarPerfil(Request $request, Response $response, array $args){
		$datos = $request->getParsedBody();
		$objPerfil = json_decode($datos['perfil']);
		$stdclass = new stdClass();
		if(Perfil::AgregarDB($objPerfil) != null){
			$stdclass->exito = true;
			$stdclass->mensaje = "Perfil Agregado";
			$stdclass->status = 200;
			$response->getBody()->write(json_encode($stdclass));
		}else{
			$stdclass->exito = false;
			$stdclass->mensaje = "Error en el agregado del perfil";
			$stdclass->status = 418;
			$response->getBody()->write(json_encode($stdclass));
		}
			
		return $response->withHeader('Content-Type', 'application/json');
	}
	public static function AgregarDB($objPerfil){
        $objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","administracion_bd"); 
        $consulta = $objetoAccesoDato->RetornarConsulta('INSERT INTO perfiles (descripcion,estado) VALUES (:descripcion,:estado)');
        $consulta->bindValue(':descripcion',$objPerfil->descripcion, PDO::PARAM_STR);
        $consulta->bindValue(':estado', $objPerfil->estado, PDO::PARAM_INT);
        
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();//???
	}
    public function MostrarPerfiles(Request $request, Response $response, array $args): Response {
        $stdclass = new stdClass();
        $AllPerfil = self::TraerTodosDB();
        if($AllPerfil!=null){
            $stdclass->exito = true;
            $stdclass->mensaje = "Ejecutado Correctamente";
            $stdclass->dato = json_encode($AllPerfil);//formato string
            $stdclass->status = 200;
            $response->getBody()->write(json_encode($stdclass));
        }else{
            $stdclass->exito = false;
            $stdclass->mensaje = "Error al traer los perfiles";
            $stdclass->dato = null;
            $stdclass->status = 424;
            $response->getBody()->write(json_encode($stdclass));
        }
        return $response->withHeader('Content-Type', 'application/json');	
    }


    public static function TraerTodosDB(){
        $objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","administracion_bd"); 
        $consulta = $objetoAccesoDato->RetornarConsulta('SELECT * FROM perfiles');
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Perfil");		
    }
    public function EliminarPerfil(Request $request, Response $response, array $args){
		$idPerfil = json_decode($request->getBody())->id_perfil;
		$token = $request->getHeader("token")[0];
		$datos = new stdClass();
		try {
			$payload = JWT::decode(
									$token,
									self::$secret_key,
									self::$encrypt
								);
			if($idPerfil != null){
                self::Eliminar($idPerfil);
                $datos->exito = true;
                $datos->mensaje = "Perfil Eliminado";
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
		$consulta = $objetoAccesoDato->RetornarConsulta('DELETE FROM perfiles WHERE id = :id');
		$consulta->bindValue(':id', $idEliminar, PDO::PARAM_INT);
			
		return $consulta->execute();				
	}

    public function ModificarPerfil(Request $request, Response $response, array $args){
		$idPerfil = json_decode($request->getBody())->id_perfil;
        $perfil = json_decode($request->getBody())->perfil;
        
		$token = $request->getHeader("token")[0];
		$datos = new stdClass();
		try {
			$payload = JWT::decode(
									$token,
									self::$secret_key,
									self::$encrypt
								);
			if($idPerfil != null && $perfil != null){
                //$objPerfil = json_decode($perfil);
                self::Modificar($idPerfil,$perfil);
                $datos->exito = true;
                $datos->mensaje = "Perfil Modificado";
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

	public static function Modificar($idModificar,$datosModificar){
		$objDatos = DB_PDO::InstanciarObjetoPDO("localhost","root","","administracion_bd");
		 $consulta = $objDatos->RetornarConsulta("UPDATE perfiles SET descripcion=:descripcion,estado=:estado WHERE perfiles.id = :id ");

		 $consulta->bindValue(':descripcion',$datosModificar->descripcion);
		 $consulta->bindValue(':estado',$datosModificar->estado);
		 $consulta->bindValue(':id',$idModificar);

		 return $consulta->execute();				
	}
}