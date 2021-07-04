<?php
    require_once "DB_PDO.php";
    require_once "Autentificadora.php";
//     Crear un apiRest con las siguientes funcionalidades:
// POST → ruta [login]:
// Se envían el correo y la clave (parámetro obj_json) a la ruta login por
// método POST.
// Se invocará al método de instancia VerificarUsuario de la clase
// Verificadora.
// Si el usuario existe en la base de datos, se creará un JWT (método de
// clase CrearJWT, de la clase Autentificadora) con todos los datos del
// usuario y 5 minutos de validez.
// Se retornará un JSON({jwt} y status 200).
// Si el usuario no existe en la base de datos, retornará el jwt nulo y el
// status 403.
    class Verificadora{
        public function VerificarUsuario(){
            $existe = false;
            $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","databaseUsuarios");
            $consulta = $objPDO->RetornarConsulta("SELECT * FROM usuarios");
            $consulta->execute();
            $arrayObjetos = array();
            while($obj = $consulta->fetchObject()){
                if($this->correo == $obj->correo && $this->clave == $obj->clave)
                Autentificadora::CrearJWT($obj);
                break;
            }
            return $existe;
        }
    }

?>