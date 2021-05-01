<?php
    include_once('Empleado.php');
    include_once('interfaces.php');
    class Fabrica implements IArchivo{
        private $cantidadMaxima;
        private $empleados;
        private $razonSocial;

        public function __construct($razonSocial = '')
        {
            $this->cantidadMaxima = 7;
            if (is_string($razonSocial)) {
                $this->razonSocial = $razonSocial;
            }
            
            $this->empleados = array();
        }
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
        public function EliminarEmpleado($emp){
            $retorno = false;//$cadena = 'El empleado no se encuentra en la lista<br>';
            if (is_a($emp,'Empleado')){
                foreach ($this->empleados as $key => $value) {
                    if ($value == $emp) {
                        unset($this->empleados[$key]);
                        unlink($emp->GetPathFoto());
                        $retorno = true;
                        break;
                    }
                }
            }
            return $retorno;
        }

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