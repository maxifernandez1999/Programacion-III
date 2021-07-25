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
	public function EliminarAuto(Request $request, Response $response, array $args){
		$idAuto = json_decode($request->getBody())->id_auto;
		$token = $request->getHeader("token")[0];
		$datos = new stdClass();
		try {

			$payload = JWT::decode(
									$token,
									self::$secret_key,
									self::$encrypt
								);
			if($idAuto != null){
				$datosAuto = $payload->data;
				if($datosAuto[0]->perfil == "propietario"){
					self::Eliminar($idAuto);
					$datos->exito = true;
					$datos->mensaje = "Auto Eliminado";
					$datos->status = 200;
				}else{
					$datos->exito = false;
					$datos->mensaje = $datosAuto[0]->nombre." No pudo eliminar el auto porque no es propietario";
					$datos->status = 418;
				}
				
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

			$datos->mensaje = $e->getMessage();
			$datos->status = 418;
			$datos->exito = false;
			$response->getBody()->write(json_encode($datos));
		
			return $response->withHeader('Content-Type', 'application/json');
		}
		
	}

	public static function Eliminar($idEliminar)
	{
		$objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","concesionaria_bd"); 
		$consulta = $objetoAccesoDato->RetornarConsulta('DELETE FROM autos WHERE id = :id');
		$consulta->bindValue(':id', $idEliminar, PDO::PARAM_INT);
			
		return $consulta->execute();				
	}

	public function ModificarAuto(Request $request, Response $response, array $args){
		$idAuto = json_decode($request->getBody())->id_auto;
		$datosAutoModificar = json_decode($request->getBody())->auto;
		$token = $request->getHeader("token")[0];
		$datos = new stdClass();
		try {

			$payload = JWT::decode(
									$token,
									self::$secret_key,
									self::$encrypt
								);
			if($idAuto != null && $datosAutoModificar != null){
				$datosAuto = $payload->data;
				if($datosAuto[0]->perfil == "encargado"){
					self::Modificar($idAuto,$datosAutoModificar);
					$datos->exito = true;
					$datos->mensaje = "Auto Modificado";
					$datos->status = 200;
				}else{
					$datos->exito = false;
					$datos->mensaje = $datosAuto[0]->nombre." No pudo modificar el auto porque no es encargado";
					$datos->status = 418;
				}
				
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

			$datos->mensaje = $e->getMessage();
			$datos->status = 418;
			$datos->exito = false;
			$response->getBody()->write(json_encode($datos));
		
			return $response->withHeader('Content-Type', 'application/json');
		}
		
	}

	public static function Modificar($idModificar,$datosModificar){ 
		$objDatos = DB_PDO::InstanciarObjetoPDO("localhost","root","","concesionaria_bd");
		 $consulta = $objDatos->RetornarConsulta("UPDATE autos SET color=:color,marca=:marca,precio=:precio,modelo=:modelo WHERE autos.id = :id ");

		 $consulta->bindValue(':color',$datosModificar->color);
		 $consulta->bindValue(':marca',$datosModificar->marca);
		 $consulta->bindValue(':precio',$datosModificar->precio);
		 $consulta->bindValue(':modelo',$datosModificar->modelo);

		 $consulta->bindValue(':id',$idModificar);

		 return $consulta->execute();

		//  if($consulta->rowCount()>0)
		//  {
		// 	 return true;
		//  }else{
		// 	 echo'No se pudo modificar';
		//  }

		//  return false;
		
	}

	

}