<?php
    class Empleado extends Persona
    {
        protected $legajo;
        protected $sueldo;
        protected $turno;

        public function __construct($nombre,$apellido,$dni,$sexo,$legajo = 0,$sueldo = 0,$turno = '')
        {
            parent::__construct($nombre,$apellido,$dni,$sexo);
            if (is_numeric($legajo) && is_numeric($sueldo)) {
                $this->legajo = $legajo;
                $this->sueldo = $sueldo;
            }
            if (is_string($turno)) {
                $this->turno = $turno;
            }
            
            
        }

        public function Hablar($idioma)
        {
            $cadena = '';
            if (is_array($idioma)) {
                $cadena = 'El empleado habla ';
                foreach ($idioma as $valor) {
                    $cadena =  $cadena.$valor.', ';
                    
                }
                echo $cadena;
            }
        }
        public function GetLegajo(){
            return $this->legajo;
        }
        public function GetSueldo(){
            return $this->sueldo;
        }
        public function GetTurno(){
            return $this->turno;
        }
        public function ToString(){
            return parent::ToString().$this->legajo.'-'.$this->sueldo.'-'.
            $this->turno;
        }
    }
?>