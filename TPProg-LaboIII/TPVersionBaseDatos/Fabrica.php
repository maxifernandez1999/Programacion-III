<?php
    include_once('Empleado.php');
    include_once('interfaces.php');
    include_once("DB_PDO.php");
    class Fabrica implements IArchivo{
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
            $this->objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","tpproglaboiii");
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
            $consulta = $this->objetoAccesoDato->RetornarConsulta("INSERT INTO empleados (nombre, apellido, dni, sexo,legajo,sueldo,turno,pathfoto) VALUES(:nombre, :apellido, :dni, :sexo, :legajo,:sueldo,:turno,:pathfoto)");
            
            $consulta->bindValue(':nombre', $empleado->GetNombre(), PDO::PARAM_STR);
            $consulta->bindValue(':apellido', $empleado->GetApellido(), PDO::PARAM_STR);
            $consulta->bindValue(':dni', $empleado->GetDni(), PDO::PARAM_INT);
            $consulta->bindValue(':sexo', $empleado->GetSexo(), PDO::PARAM_STR);
            $consulta->bindValue(':legajo', $empleado->GetLegajo(), PDO::PARAM_INT);
            $consulta->bindValue(':sueldo', $empleado->GetSueldo(), PDO::PARAM_INT);
            $consulta->bindValue(':turno', $empleado->GetTurno(), PDO::PARAM_STR);
            $consulta->bindValue(':pathfoto', $empleado->GetPathFoto(), PDO::PARAM_STR);
            $consulta->execute();   
    
        }
        
        public function UpdateEmpleado($empleado)
        {
            $consulta = $this->objetoAccesoDato->RetornarConsulta("UPDATE empleados SET nombre = :nombre, apellido = :apellido, sexo = :sexo, legajo = :legajo, sueldo = :sueldo, turno = :turno,pathfoto = :pathfoto WHERE dni = :dni");
            
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
            
            $consulta = $this->objetoAccesoDato->RetornarConsulta("DELETE FROM empleados WHERE id = :id");
            $consulta->bindValue(':id', $idEliminar, PDO::PARAM_INT);
            $consulta->execute();
        }

        ////////////////////////////////////////
        public function TraerDeArchivo($nombreArchivo){
            if (file_exists($nombreArchivo)) {
                if (!empty($nombreArchivo)) {
                    $archivo = fopen($nombreArchivo,"r");
                    while(!feof($archivo)) {
                        $archivotxt = trim(fgets($archivo));
                        $arrayEmpleados = explode('-',$archivotxt);
                            if ($arrayEmpleados[0] != null) {
                            $objEmpleado = new Empleado($arrayEmpleados[0],$arrayEmpleados[1],$arrayEmpleados[2],$arrayEmpleados[3],$arrayEmpleados[4],$arrayEmpleados[5],$arrayEmpleados[6],$arrayEmpleados[7]);
                            $this->AgregarEmpleado($objEmpleado);
                        }
                    }
                    fclose($archivo);
                }
                
            }else{
                $archivo = fopen($nombreArchivo,"x");
                fclose($archivo);
            }
            
        }
        public function GuardarEnArchivo($nombreArchivo){
            $archivo = fopen($nombreArchivo,"w");
            foreach ($this->empleados as $empleado) {
            $valor = fwrite($archivo,$empleado->ToString()."\r\n");
                if ($valor < 0) {
                    echo 'Error en la escritura';
                }
            }
            
            fclose($archivo);
        }
        public function AgregarEmpleado($emp){
            if (is_a($emp,'Empleado') && count($this->empleados) < $this->cantidadMaxima) {
                array_push($this->empleados,$emp);
                $this->EliminarEmpleadosRepetidos();
                return true;
            }
            return false;
        }
        public function CalcularSueldos(){
            $acumulador = 0;
            foreach ($this->empleados as $value) {
                $acumulador = $acumulador + $value->GetSueldo();
            }
            return $acumulador;
        }
        // public function EliminarEmpleado($emp){
        //     $retorno = false;//$cadena = 'El empleado no se encuentra en la lista<br>';
        //     if (is_a($emp,'Empleado')){
        //         foreach ($this->empleados as $key => $value) {
        //             if ($value == $emp) {
        //                 unset($this->empleados[$key]);
        //                 unlink($emp->GetPathFoto());
        //                 $retorno = true;
        //                 break;
        //             }
        //         }
        //     }
        //     return $retorno;
        // }

        private function EliminarEmpleadosRepetidos(){
            $arrayModificado = array_unique($this->empleados,SORT_REGULAR);
            $this->empleados = $arrayModificado;
             
        }
        public function GetEmpleados(){
            return $this->empleados;
        }
        public function GetCantidadMaxima(){
            return $this->cantidadMaxima;
        }
        public function ToString(){
            $cadenaEmpleados = '';
            foreach ($this->empleados as $emp) {
                $cadenaEmpleados = $cadenaEmpleados . $emp->ToString().'<br>';
            }
            $cadena = 'Cantidad maxima de empleados: '.$this->cantidadMaxima.'- '.'Razon Social: '.$this->razonSocial.'- '.'Empleados: '.'- '.$cadenaEmpleados;
            return $cadena;
        }
        
    }


?>