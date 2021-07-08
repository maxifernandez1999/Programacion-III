<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once "AccesoDatos.php";


class Cd
{
	public $titulo;
	public $origen;
    public $fechaLanzamiento;
    public $id;

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

		$id = $arrayParams['id'];
        $origen = $arrayParams['origen'];
        $titulo = $arrayParams['titulo'];
		$fechaLanzamiento = $arrayParams['fechaLanzamiento'];
        

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
		$cd->id = $id;
		$cd->origen = $origen;
		$cd->titulo = $titulo;
		$cd->fechaLanzamiento = $fechaLanzamiento;
		$stdclass = new stdClass();
        $stdclass->id_agregado = $cd->AgregarDB();
		$stdclass->mensaje = "Usuario '$stdclass->id_agregado' agregado";
		$response->getBody()->write(json_encode($stdclass));

      	return $response->withHeader('Content-Type', 'application/json');
    }
	
	public function Modificar(Request $request, Response $response, array $args): Response
	{
		$obj = json_decode(($args["cadenaJson"]));   

	    $cd = new Cd();
		$cd->id = $obj->id;
	    $cd->titulo = $obj->titulo;
	    $cd->origen = $obj->origen;
	    $cd->fechaLanzamiento = $obj->fechaLanzamiento;
		$result = $cd->ModificarDB(); 
	   	$objResponse = new stdclass();
		$objResponse->mensaje = $result;

		$newResponse = $response->withStatus(200, "OK");
		$newResponse->getBody()->write(json_encode($objResponse));

		return $newResponse->withHeader('Content-Type', 'application/json');		
	}
	
	public function Eliminar(Request $request, Response $response, array $args): Response 
	{		 
     	$id = $args['id'];
		 
		$User = new Cd();
		$User->id = $id;
     	$countDelete = $User->EliminarDB();
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
		$consulta =$objetoAccesoDato->RetornarConsulta('SELECT usuarios.id, usuarios.nombre, usuarios.apellido, usuarios.correo, usuarios.clave, usuarios.foto, usuarios.idPerfil FROM usuarios');
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");		
	}

	public static function TraerUnoDB($id) 
	{
		$objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","databaseUsuarios"); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT usuarios.id, usuarios.nombre, usuarios.apellido, usuarios.correo, usuarios.clave, usuarios.foto, usuarios.idPerfil FROM usuarios WHERE id = $id");
		$consulta->execute();
		$buscado = $consulta->fetchObject('Usuario');
		return $buscado;		
	}

	public function AgregarDB()
	{
		$objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","databaseUsuarios"); 
		$consulta = $objetoAccesoDato->RetornarConsulta('INSERT INTO usuarios (nombre,apellido,correo,clave,foto,idPerfil) VALUES (:nombre,:apellido,:correo,:clave,:foto,:idPerfil)');
		$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
		$consulta->bindValue(':correo', $this->correo, PDO::PARAM_STR);
		$consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
		$consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);
		$consulta->bindValue(':idPerfil', $this->idPerfil, PDO::PARAM_INT);
		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();//???
	}

	public function ModificarDB()
	{
		$objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","databaseUsuarios"); 
		$consulta =$objetoAccesoDato->RetornarConsulta('UPDATE usuarios SET nombre = :nombre, apellido = :apellido, correo = :correo, clave = :clave, foto = :foto, idPerfil = :idPerfil WHERE id = :id');
		$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
		$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
		$consulta->bindValue(':correo', $this->correo, PDO::PARAM_STR);
		$consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
		$consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);
		$consulta->bindValue(':idPerfil', $this->idPerfil, PDO::PARAM_INT);
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