<?php

    include_once("DB_PDO.php");
    include_once("IBM.php");
    class Usuario implements IBM
    {
        public $id;
        public $nombre;
        public $correo;
        public $clave;
        public $id_perfil;
        public $perfil;
        
        public function __construct($id,$nombre,$correo,$clave,$id_perfil,$perfil)
        {
            $this->id = $id;
            $this->id_perfil = $id_perfil;
            $this->perfil = $perfil;
            $this->nombre = $nombre;
            $this->clave = $clave;
            $this->correo = $correo;
        }
        public function toJSON(){ 
            $json = "{\"nombre\":\"$this->nombre\",\"correo\":\"$this->correo\",\"clave\":\"$this->clave\"}";
            return $json;
        }

        public function GuardarEnArchivo(){
            $archivo = fopen('./archivos/usuarios.json','a');
            $obj = json_encode($this);
            $retorno = fwrite($archivo,$obj."\r\n");
            $exito = $retorno != false ? true : false;
            fclose($archivo);
            $mensaje = $exito == false ? "No se pudo escribir en el archivo" : "Se pudo escribir en el archivo JSON";
            return "{'exito':$exito,'mensaje':$mensaje}";
        }
        public static function TraerTodosJSON(){
            $arrayObjetosJSON = array();
            $nameFile = './archivos/usuarios.json';
            if (file_exists($nameFile)) {
                if(filesize($nameFile) > 0){
                    $archivo = fopen($nameFile,"r");
                    while(!feof($archivo)){
                        $file = fgets($archivo);
                        array_push($arrayObjetosJSON,$file);
                    }
                    fclose($archivo);
                }
            }
            return $arrayObjetosJSON;
        }

        public function Agregar(){//id autoincremental
            $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","usuarios_test");
            $consulta = $objPDO->RetornarConsulta("INSERT INTO usuarios (nombre, correo, clave,id_perfil) VALUES(:nombre, :correo, :clave,:id_perfil)");
            $consulta->bindValue(':correo', $this->correo, PDO::PARAM_STR);
            $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
            $consulta->bindValue(':id_perfil', $this->id_perfil, PDO::PARAM_INT);
            $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
            //$consulta->bindValue(':id', $this->clave, PDO::PARAM_STR);
            $success = $consulta->execute() == true ? true : false;
            return $success;
        }

        public static function TraerTodos(){
            $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","usuarios_test");
            $consulta = $objPDO->RetornarConsulta("SELECT usuarios.id,usuarios.correo, usuarios.clave, usuarios.nombre,usuarios.id_perfil, perfiles.descripcion FROM usuarios INNER JOIN perfiles ON usuarios.id_perfil = perfiles.id");
            $consulta->execute();
            $arrayObjetos = array();
            while($obj = $consulta->fetchObject()){
                $usuario = new Usuario($obj->id,$obj->nombre,$obj->correo,$obj->clave,$obj->id_perfil,$obj->descripcion);
                array_push($arrayObjetos,$usuario);
            }
            return $arrayObjetos;
        }

        public static function TraerUno($correo,$clave){//puede ser un obj o array
            $arrayObjetos = self::TraerTodos();
            $retorno = false;
            foreach ($arrayObjetos as $obj) {
                if ($obj->correo == $correo && $obj->clave == $clave) {
                    $retorno = $obj;
                }
            }
            return $retorno;
        }
        public function Modificar(){ 
            $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","usuarios_test");
            $consulta = $objPDO->RetornarConsulta( "UPDATE usuarios SET correo = :correo, clave = :clave, nombre = :nombre, id_perfil = :id_perfil WHERE id = :id");
            $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
            $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
            $consulta->bindValue(':correo', $this->correo, PDO::PARAM_STR);
            $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
            $consulta->bindValue(':id_perfil', $this->id_perfil, PDO::PARAM_INT);
            $retorno = $consulta->execute() != false ? true : false;
            return $retorno;
        }
        public static function Eliminar($id){
            $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","usuarios_test");
            $consulta = $objPDO->RetornarConsulta( "DELETE FROM usuarios WHERE id = :id");
            $consulta->bindValue(':id', $id, PDO::PARAM_INT);
            if($consulta->execute()){
                return true;
            }else{
                false;
            }
            
        }
    }
