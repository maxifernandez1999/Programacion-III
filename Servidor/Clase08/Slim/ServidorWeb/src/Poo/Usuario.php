<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once "AccesoDatos.php";
require_once "ISlim.php";

class Usuario implements ISlim
{
	public $nombre;
	public $apellido;
	public $correo;
	public $clave;
	public $foto;
	public $idPerfil;

//*********************************************************************************************//
/* IMPLEMENTO LAS FUNCIONES PARA SLIM */
//*********************************************************************************************//

	public function GetAll(Request $request, Response $response, array $args): Response 
	{
		$AllUser = Usuario::GetAllUser();
  
		$newResponse = $response->withStatus(200, "OK");
		$newResponse->getBody()->write(json_encode($AllUser));

		return $newResponse->withHeader('Content-Type', 'application/json');	
	}

	public function GetOne(Request $request, Response $response, array $args): Response 
	{
     	$id = $args['id'];
    	$User = Usuario::GetUser($id);

		$newResponse = $response->withStatus(200, "OK");
		$newResponse->getBody()->write(json_encode($User));	

		return $newResponse->withHeader('Content-Type', 'application/json');
	}
	
	public function Add(Request $request, Response $response, array $args): Response 
	{
        $arrayParams = $request->getParsedBody();

		$nombre = $arrayParams['nombre'];
        $apellido = $arrayParams['apellido'];
        $correo = $arrayParams['correo'];
		$clave = $arrayParams['clave'];
		$idPerfil = $arrayParams['idPerfil'];
        

//*********************************************************************************************//
//SUBIDA DE ARCHIVOS (SE PUEDEN TENER FUNCIONES DEFINIDAS)
//*********************************************************************************************//

		$file = $request->getUploadedFiles();//$_FILES
        $destiny = __DIR__ . "/../fotos/";

        $nameBefore = $file['foto']->getClientFilename();
        $extension = explode(".", $nameBefore);
		
        $extension = array_reverse($extension);
		$finalyFile = $apellido . "." . $extension[0];
		$file['foto']->moveTo($destiny . $finalyFile);
		$User = new Usuario();
		$User->nombre = $nombre;
		$User->apellido = $apellido;
		$User->correo = $correo;
		$User->clave = $clave;
		$User->foto = $finalyFile;
		$User->idPerfil = $idPerfil;	
		$idAdd = $User->InsertUser();
		$response->getBody()->write("User by ID = '$idAdd' was added");

      	return $response;
    }
	
	public function Modify(Request $request, Response $response, array $args): Response
	{
		$obj = json_decode(($args["cadenaJson"]));   

	    $User = new Usuario();
		$User->id = $obj->id;
	    $User->nombre = $obj->nombre;
	    $User->apellido = $obj->apellido;
	    $User->correo = $obj->correo;
	    $User->clave = $obj->clave;
		$User->foto = $obj->foto;
		$User->idPerfil = $obj->idPerfil;
		//{"id":1,"nombre":"pablo","apellido":"fernandez","correo":"pablo@pablo.com","clave":"pablo123","foto":"fotopath","idPerfil":2}
		$result = $User->ModifyUser(); 
	   	$objResponse = new stdclass();
		$objResponse->result = $result;

		$newResponse = $response->withStatus(200, "OK");
		$newResponse->getBody()->write(json_encode($objResponse));

		return $newResponse->withHeader('Content-Type', 'application/json');		
	}
	
	public function Delete(Request $request, Response $response, array $args): Response 
	{		 
     	$id = $args['id'];
		 
		$User = new Usuario();
		$User->id = $id;
     	$countDelete = $User->DeleteUser();
     	$objResponse = new stdclass();
		$objResponse->count = $countDelete;
		
	    if($countDelete > 0)
	    {
	    	$objResponse->result = "User deleted";
	    }
	    else
	    {
	    	$objResponse->result = "Error";
		}

		$newResponse = $response->withStatus(200, "OK");
		$newResponse->getBody()->write(json_encode($objResponse));	

		return $newResponse->withHeader('Content-Type', 'application/json');
    }
	
//*********************************************************************************************//
/* FIN - AGREGO FUNCIONES PARA SLIM */
//*********************************************************************************************//

	public static function GetAllUser()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta('SELECT usuarios.id, usuarios.nombre, usuarios.apellido, usuarios.correo, usuarios.clave, usuarios.foto, usuarios.idPerfil FROM usuarios');
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");		
	}

	public static function GetUser($id) 
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT usuarios.id, usuarios.nombre, usuarios.apellido, usuarios.correo, usuarios.clave, usuarios.foto, usuarios.idPerfil FROM usuarios WHERE id = $id");
		$consulta->execute();
		$buscado = $consulta->fetchObject('Usuario');
		return $buscado;		
	}

	public function InsertUser()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
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

	public function ModifyUser()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
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

	public function DeleteUser()
	{
	 	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta('DELETE FROM usuarios	WHERE id = :id');	
		$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
	}

}