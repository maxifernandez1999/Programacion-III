<?php
    include_once('Empleado.php');
    include_once('interfaces.php');
    include_once("DB_PDO.php");
    class Fabrica implements ISQL{
        private $cantidadMaxima;
        private $empleados;
        private $razonSocial;
        private $objetoAccesoDato;
        public function __construct($razonSocial = '')
        {
            $this->cantidadMaxima = 7;
            if (is_string($razonSocial)) {
                $this->razonSocial = $razonSocial;
            }
            $this->objetoAccesoDato = DB_PDO::InstanciarObjetoPDO('localhost','root','','tpproglaboiii');
            $this->empleados = array();
        }
        public function SelectEmpleados()
        {   
            $consulta = $this->objetoAccesoDato->RetornarConsulta("SELECT * FROM empleados");        
            $consulta->execute();
            return $consulta; 
        }
        
        public function InsertEmpleado($empleado)
        {
            $consulta = $this->objetoAccesoDato->RetornarConsulta('INSERT INTO empleados (nombre, apellido, dni, sexo,legajo,sueldo,turno,pathfoto) VALUES(:nombre, :apellido, :dni, :sexo, :legajo,:sueldo,:turno,:pathfoto)');
            
            $consulta->bindValue(':nombre', $empleado->GetNombre(), PDO::PARAM_STR);
            $consulta->bindValue(':apellido', $empleado->GetApellido(), PDO::PARAM_STR);
            $consulta->bindValue(':dni', $empleado->GetDni(), PDO::PARAM_INT);
            $consulta->bindValue(':sexo', $empleado->GetSexo(), PDO::PARAM_STR);
            $consulta->bindValue(':legajo', $empleado->GetLegajo(), PDO::PARAM_INT);
            $consulta->bindValue(':sueldo', $empleado->GetSueldo(), PDO::PARAM_INT);
            $consulta->bindValue(':turno', $empleado->GetTurno(), PDO::PARAM_STR);
            $consulta->bindValue(':pathfoto', $empleado->GetPathFoto(), PDO::PARAM_STR);
            $consulta->execute();
            return true;   
    
        }
        
        public function UpdateEmpleado($empleado)
        {
            $consulta = $this->objetoAccesoDato->RetornarConsulta('UPDATE empleados SET nombre = :nombre, apellido = :apellido, sexo = :sexo, legajo = :legajo, sueldo = :sueldo, turno = :turno,pathfoto = :pathfoto WHERE dni = :dni');
            
            $consulta->bindValue(':nombre',$empleado->nombre, PDO::PARAM_STR);
            $consulta->bindValue(':apellido', $empleado->apellido, PDO::PARAM_STR);
            $consulta->bindValue(':dni', $empleado->dni, PDO::PARAM_INT);
            $consulta->bindValue(':sexo',$empleado->sexo, PDO::PARAM_STR);
            $consulta->bindValue(':legajo', $empleado->legajo, PDO::PARAM_INT);
            $consulta->bindValue(':sueldo', $empleado->sueldo, PDO::PARAM_INT);
            $consulta->bindValue(':turno', $empleado->turno, PDO::PARAM_STR);
            $consulta->bindValue(':pathfoto',  $empleado->pathfoto, PDO::PARAM_STR);
    
            $consulta->execute();
    
        }
    
        public function DeleteEmpleado($idEliminar){   
            
            $consulta = $this->objetoAccesoDato->RetornarConsulta('DELETE FROM empleados WHERE id = :id');
            $consulta->bindValue(':id', $idEliminar, PDO::PARAM_INT);
            $consulta->execute();
        }
        public function GetEmpleados(){
            return $this->empleados;
        }
        public function GetCantidadMaxima(){
            return $this->cantidadMaxima;
        }

        
        
    }


?>