<?php
    include_once("DB_PDO.php");
    include_once("Usuario.php");
    include_once("ICRUD.php");
    class Empleado extends Usuario implements ICRUD{
        public $sueldo;
        public $foto;

        public function __construct($id,$nombre,$correo,$clave,$id_perfil,$perfil,$foto,$sueldo)
        {
            parent::__construct($id,$nombre,$correo,$clave,$id_perfil,$perfil);
            $this->foto = $foto;
            $this->sueldo = $sueldo;
        }
        public static function TraerTodos(){
            $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","usuarios_test");
            $consulta = $objPDO->RetornarConsulta("SELECT empleados.id,empleados.correo, empleados.clave, empleados.nombre,empleados.id_perfil, empleados.foto, empleados.sueldo, perfiles.descripcion FROM empleados INNER JOIN perfiles ON empleados.id_perfil = perfiles.id");
            $consulta->execute();
            $arrayObjetos = array();
            while($obj = $consulta->fetchObject()){
                $empleado = new Empleado($obj->id,$obj->nombre,$obj->correo,$obj->clave,$obj->id_perfil,$obj->descripcion,$obj->foto,$obj->sueldo);
                array_push($arrayObjetos,$empleado);
            }
            return $arrayObjetos;
        }
        public function Agregar(){
            $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","usuarios_test");
            $consulta = $objPDO->RetornarConsulta("INSERT INTO empleados (nombre, correo, clave,id_perfil,foto,sueldo) VALUES(:nombre, :correo, :clave,:id_perfil,:foto,:sueldo)");
            $consulta->bindValue(':correo', $this->correo, PDO::PARAM_STR);
            $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
            $consulta->bindValue(':id_perfil', $this->id_perfil, PDO::PARAM_INT);
            $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
            $consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);
            $consulta->bindValue(':sueldo', $this->sueldo, PDO::PARAM_STR);
            $success = $consulta->execute() == true ? true : false;
            return $success;
        }
        public function Modificar(){ 
            $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","usuarios_test");
            $consulta = $objPDO->RetornarConsulta( "UPDATE empleados SET correo = :correo, clave = :clave, nombre = :nombre, id_perfil = :id_perfil, foto = :foto , sueldo = :sueldo WHERE id = :id");
            $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
            $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
            $consulta->bindValue(':correo', $this->correo, PDO::PARAM_STR);
            $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
            $consulta->bindValue(':id_perfil', $this->id_perfil, PDO::PARAM_INT);
            $consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);
            $consulta->bindValue(':sueldo', $this->sueldo, PDO::PARAM_STR);
            $retorno = $consulta->execute() != false ? true : false;
            return $retorno;
        }
        public static function Eliminar($id){
            $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","usuarios_test");
            $consulta = $objPDO->RetornarConsulta( "DELETE FROM empleados WHERE id = :id");
            $consulta->bindValue(':id', $id, PDO::PARAM_INT);
            if($consulta->execute()){
                return true;
            }else{
                false;
            }
            
        }
    }

?>