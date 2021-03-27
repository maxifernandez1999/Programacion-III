<?php
    class Fabrica{
        private $cantidadMaxima;
        private $empleados;
        private $razonSocial;

        public function __construct($razonSocial = '')
        {
            $this->cantidadMaxima = 5;
            if (is_string($razonSocial)) {
                $this->razonSocial = $razonSocial;
            }
            
            $this->empleados = array();
        }

        public function AgregarEmpleado($emp){
            if (is_a($emp,'Empleado') && count($this->empleados) < $this->cantidadMaxima) {
                array_push($this->empleados,$emp);
                $this->EliminarEmpleadosRepetidos();
            }
        }
        public function CalcularSueldos(){
            $acumulador = 0;
            foreach ($this->empleados as $value) {
                $acumulador = $acumulador + $value->GetSueldo();
            }
            return $acumulador;
        }
        public function EliminarEmpleado($emp){
            $cadena = 'El empleado no se encuentra en la lista<br>';
            if (is_a($emp,'Empleado')){
                foreach ($this->empleados as $key => $value) {
                    if ($value == $emp) {
                        unset($this->empleados[$key]);
                        $cadena = 'Empleado eliminado<br>';
                        echo $cadena;
                        break;
                    }
                }
            }
        }

        private function EliminarEmpleadosRepetidos(){
            $arrayModificado = array_unique($this->empleados,SORT_REGULAR);
            $this->empleados = $arrayModificado;
             
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