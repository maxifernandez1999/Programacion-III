<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as ResponseMW;
 
require_once "DB_PDO.php";

    class Usuario{

        public $correo;
        public $clave;
        public $nombre;
        public $apellido;
        public $perfil;
        public $foto;

        // function __construct($correo,$clave,$nombre,$apellido,$perfil,$foto){
        //     $this->correo = $correo;
        //     $this->clave = $clave;
        //     $this->nombre = $nombre;
        //     $this->apellido = $apellido;
        //     $this->perfil = $perfil;
        //     $this->foto = $foto;

        // }
        // public static function AgregarFoto($file,$idInsert,$objJSON){
            
        //     return $finalyFile;
        // }
        public function AgregarUsuario(Request $request, Response $response, array $args){
            $objJSON = json_decode($request->getParsedBody()['usuario']);
            $stdclass = new stdClass();
            
            
            


            $file = $request->getUploadedFiles();//$_FILES
                $destiny = __DIR__ . "/../fotos/";

                $nameBefore = $file['foto']->getClientFilename();
                $extension = explode(".", $nameBefore);
            
                $extension = array_reverse($extension);
                $finalyFile = $objJSON->correo. "." . $extension[0];
                $file['foto']->moveTo($destiny . $finalyFile);



            //$finalFile = self::AgregarFoto($file,$idInsert,$objJSON);
            
        $user = new Usuario($objJSON->correo,$objJSON->clave,$objJSON->nombre,$objJSON->apellido,$objJSON->perfil,$finalyFile);
            $idInsert = $user->Insertar();
            if($idInsert!= null){
                
                


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

        public function Insertar()
        {
            $objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","concesionaria_bd"); 
            $consulta = $objetoAccesoDato->RetornarConsulta('INSERT INTO usuarios(correo,clave,nombre,apellido,perfil) VALUES (:correo,:clave,:nombre,:apellido,:perfil)');
            $consulta->bindValue(':correo',$this->correo, PDO::PARAM_STR);
            $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
            $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
            $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
            $consulta->bindValue(':perfil', $this->perfil, PDO::PARAM_STR);
            $consulta->bindValue(':perfil', $this->foto, PDO::PARAM_STR);
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