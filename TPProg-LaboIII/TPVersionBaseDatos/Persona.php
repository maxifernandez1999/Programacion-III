<?php
    abstract class Persona{
        public $apellido;
        public $dni;
        public $nombre;
        public $sexo;

        public function __construct($nombre = '',$apellido = '',$dni = 0,$sexo = '')
        {
            if (is_string($nombre) && is_string($apellido) && is_string($sexo)) {
                $this->nombre = $nombre;
                $this->apellido = $apellido;
                $this->sexo = $sexo;
            }
            if (is_numeric($dni)) {
                $this->dni = $dni;
            }
            
            
            
        }

        public function GetDni(){
            return $this->dni;
        }
        public function GetApellido(){
            return $this->apellido;
        }
        public function GetSexo(){
            return $this->sexo;
        }
        public function GetNombre(){
            return $this->nombre;
        }
        public abstract function Hablar($idioma);

        public function ToString(){
            return $this->nombre.'-'.$this->apellido.'-'.
            $this->dni.'-'.$this->sexo.'-';
        }
            
        
    }

?>