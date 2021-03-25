<?php
    class Fabrica{
        private $_cantidadMaxima;
        private $_empleados;
        private $_razonSocial;

        public function __construct($empleados,$razonSocial)
        {
            $this->_cantidadMaxima = 5;
            $this->_empleados = $empleados;
            $this->_razonSocial = $razonSocial;
        }

        public function AgregarEmpleado($emp){
            if (is_a($emp,'Empleado') && count($this->_empleados) < $this->_cantidadMaxima) {
                array_push($this->_empleados,$emp);
                $this->EliminarEmpleadosRepetidos();
            }
        }
        public function CalcularSueldos(){
            $acumulador = 0;
            foreach ($this->_empleados as $value) {
                $acumulador = $acumulador + $value->_sueldo;
            }
            return $acumulador;
        }
        public function EliminarEmpleado($emp){
            if (is_a($emp,'Empleado')){
                foreach ($this->_empleados as $value) {
                    if ($value == $emp) {
                        unset($emp);
                    }else{
                        echo 'El empleado no se encuentra en la lista';
                    }
                }
            }
        }

        private function EliminarEmpleadosRepetidos(){
            array_unique($this->_empleados);
        }
        public function ToString(){
            $cadenaEmpleados = '';
            foreach ($this->_empleados as $emp) {
                
                $cadenaEmpleados = $cadenaEmpleados . $emp->ToString().'<br>';
            }
            $cadena = 'Cantidad maxima de empleados: '.$this->_cantidadMaxima.'- '.'Razon Social: '.$this->_razonSocial.'- '.'Empleados: '.'- '.$cadenaEmpleados;
            return $cadena;
        }
        
    }


?>