<?php
    include_once('Persona.php');
    class Empleado extends Persona
    {
        protected $legajo;
        protected $pathFoto;
        protected $sueldo;
        protected $turno;

        public function __construct($nombre,$apellido,$dni,$sexo,$legajo = 0,$sueldo = 0,$turno = '',$pathFoto = '')
        {
            parent::__construct($nombre,$apellido,$dni,$sexo);
            if (is_numeric($legajo) && is_numeric($sueldo)) {
                $this->legajo = $legajo;
                $this->sueldo = $sueldo;
            }
            if (is_string($turno)) {
                $this->turno = $turno;
                $this->pathFoto = $pathFoto;
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
        public function GetPathFoto(){
            return $this->pathFoto;
        }
        public function SetPathFoto($foto){
            $this->pathFoto = $foto;
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
            $this->turno.'-'.$this->pathFoto;
        }
    }
?>