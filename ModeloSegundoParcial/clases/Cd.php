<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once "DB_PDO.php";


class Cd
{
	public $correo;
	public $clave;
	public $id;
	public $titulo;
	public $cantante;
    public $anio;
    

//*********************************************************************************************//
/* IMPLEMENTO LAS FUNCIONES PARA SLIM */
//*********************************************************************************************//

	public function TraerTodos(Request $request, Response $response, array $args): Response 
	{
		$AllUser = self::TraerTodosDB();
  
		$newResponse = $response->withStatus(200, "OK");
		$newResponse->getBody()->write(json_encode($AllUser));

		return $newResponse->withHeader('Content-Type', 'application/json');	
	}

	public function TraerUno(Request $request, Response $response, array $args): Response 
	{
     	$id = $args['id'];
    	$User = self::TraerUnoDB($id);

		$newResponse = $response->withStatus(200, "OK");
		$newResponse->getBody()->write(json_encode($User));	

		return $newResponse->withHeader('Content-Type', 'application/json');
	}
	
	public function Agregar(Request $request, Response $response, array $args): Response 
	{
        $arrayParams = $request->getParsedBody();
		$correo = $arrayParams['correo'];
		$clave = $arrayParams['clave'];
        $cantante = $arrayParams['cantante'];
        $titulo = $arrayParams['titulo'];
		$anio = $arrayParams['anio'];
        

//*********************************************************************************************//
//SUBIDA DE ARCHIVOS (SE PUEDEN TENER FUNCIONES DEFINIDAS)
//*********************************************************************************************//

		// $file = $request->getUploadedFiles();//$_FILES
        // $destiny = __DIR__ . "/../fotos/";

        // $nameBefore = $file['foto']->getClientFilename();
        // $extension = explode(".", $nameBefore);
		
        // $extension = array_reverse($extension);
		// $finalyFile = $apellido . "." . $extension[0];
		// $file['foto']->moveTo($destiny . $finalyFile);
		$cd = new Cd();
		$cd->correo = $correo;
		$cd->clave = $clave;
		$cd->cantante = $cantante;
		$cd->titulo = $titulo;
		$cd->anio = $anio;
		$stdclass = new stdClass();
        $stdclass->id_agregado = $cd->AgregarDB();
		$stdclass->mensaje = "Usuario '$stdclass->id_agregado' agregado";
		$response->getBody()->write(json_encode($stdclass));

      	return $response->withHeader('Content-Type', 'application/json');
    }
	
	public function Modificar(Request $request, Response $response, array $args): Response
	{
		$obj = $args['obj_json']; 
		$json = json_decode($obj);
	    $cd = new Cd();
		$cd->id = $json->id;
	    $cd->titulo = $json->titulo;
	    $cd->anio = $json->anio;
	    $cd->correo = $json->correo;
		$cd->clave = $json->clave;
		$cd->cantante = $json->cantante;
		$result = $cd->ModificarDB(); 
	   	$objResponse = new stdclass();
		$objResponse->mensaje = $result;

		$newResponse = $response->withStatus(200, "OK");
		$newResponse->getBody()->write(json_encode($objResponse));

		return $newResponse->withHeader('Content-Type', 'application/json'); 		
	}
	
	public function Eliminar(Request $request, Response $response, array $args): Response 
	{		 
		$idEliminar = $args['id']; 
		 
		$cd = new Cd();
		$cd->id = $idEliminar;
     	$countDelete = $cd->EliminarDB();
     	$objResponse = new stdclass();
		$objResponse->cantidad = $countDelete;
		
	    if($countDelete > 0)
	    {
	    	$objResponse->mensaje = "Usuario Eliminado";
	    }
	    else
	    {
	    	$objResponse->mensaje = "Error";
		}

		$newResponse = $response->withStatus(200, "OK");
		$newResponse->getBody()->write(json_encode($objResponse));	

		return $newResponse->withHeader('Content-Type', 'application/json');
    }
	
//*********************************************************************************************//
/* FIN - AGREGO FUNCIONES PARA SLIM */
//*********************************************************************************************//

	public static function TraerTodosDB()
	{
		$objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","databaseUsuarios"); 
		$consulta =$objetoAccesoDato->RetornarConsulta('SELECT * FROM usuarios');
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "Cd");		
	}

	public static function TraerUnoDB($id) 
	{
		$objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","databaseUsuarios"); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE id = $id");
		$consulta->execute();
		$buscado = $consulta->fetchObject('Cd');
		return $buscado;		
	}

	public function AgregarDB()
	{
		$objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","databaseUsuarios"); 
		$consulta = $objetoAccesoDato->RetornarConsulta('INSERT INTO usuarios (correo,clave,titulo,cantante,anio) VALUES (:correo,:clave,:titulo,:cantante,:anio)');
		$consulta->bindValue(':correo',$this->correo, PDO::PARAM_STR);
		$consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
		$consulta->bindValue(':titulo', $this->titulo, PDO::PARAM_STR);
		$consulta->bindValue(':cantante', $this->cantante, PDO::PARAM_STR);
		$consulta->bindValue(':anio', $this->anio, PDO::PARAM_INT);
		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();//???
	}

	public function ModificarDB()
	{
		$objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","databaseUsuarios"); 
		$consulta =$objetoAccesoDato->RetornarConsulta('UPDATE usuarios SET clave = :clave, correo = :correo, titulo = :titulo, cantante = :cantante, anio = :anio WHERE id = :id');
		$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
		$consulta->bindValue(':clave',$this->clave, PDO::PARAM_STR);
		$consulta->bindValue(':correo', $this->correo, PDO::PARAM_STR);
		$consulta->bindValue(':titulo', $this->titulo, PDO::PARAM_STR);
		$consulta->bindValue(':cantante', $this->cantante, PDO::PARAM_STR);
		$consulta->bindValue(':anio', $this->anio, PDO::PARAM_INT);

		return $consulta->execute();
	 }

	public function EliminarDB()
	{
	 	$objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","databaseUsuarios"); 
		$consulta =$objetoAccesoDato->RetornarConsulta('DELETE FROM usuarios	WHERE id = :id');	
		$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
	}

}