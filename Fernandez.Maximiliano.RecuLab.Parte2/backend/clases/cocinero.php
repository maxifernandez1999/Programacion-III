<?php

    include_once("DB_PDO.php");
    class Cocinero 
    {
        public $especialidad;
        public $email;
        public $clave;
        
        public function __construct($especialidad,$email,$clave)
        {
            $this->especialidad = $especialidad;
            $this->email = $email;
            $this->clave = $clave;
            
        }

        // public function GetEspecialidad(){
        //     return $this->especialidad;
        // }
        // public function GetEmail(){
        //     return $this->email;
        // }
        // public function GetClave(){
        //     return $this->clave;
        // }

        // public function SetEspecialidad($especialidad){
        //     $this->especialidad = $especialidad;
        // }
        // public function SetEmail($email){
        //     $this->email = $email;
        // }
        // public function SetClave($clave){
        //     $this->clave = $clave;
        // }

        public function toJSON(){
            return json_encode($this);
            
        }
        public function GuardarEnArchivo($path){
            $stdClass = new stdClass();
            $arrayjson = self::TraerTodos($path);
            //$cocinero = new Cocinero($this->GetEspecialidad(),$this->GetEmail(),$this->GetClave());
            
            array_push($arrayjson,$this);
            $archivo = fopen($path,'w');
            $retorno = fwrite($archivo,json_encode($arrayjson)/*."\r\n"*/);
            if ($retorno == true) {
                $stdClass->exito = true;
                $stdClass->mensaje = "Se pudo escribir en el archivo JSON";
            }else{
                $stdClass->exito = false;
                $stdClass->mensaje = "No se pudo escribir en el archivo";
            }
            fclose($archivo);
            return json_encode($stdClass);
        }
        public static function TraerTodos($path){
            $arrayObjetos = array();
            $nameFile = $path;
            if (file_exists($nameFile)) {
                if(filesize($nameFile) > 0){
                    $archivo = fopen($nameFile,"r");
                    $contenido = fread($archivo, filesize($nameFile));
                    $array = json_decode($contenido);
                    foreach ($array as $objeto) {
                        $cocinero = new Cocinero($objeto->especialidad,$objeto->email,$objeto->clave);
                        array_push($arrayObjetos,$cocinero);
                    }  
                    fclose($archivo); 
                }
                    
            }
            
            return $arrayObjetos;
        }
        private static function MasPopularesEspecialidades($masPopulares){
            $count = array();
            $arrayAsocc = array_count_values($masPopulares);
            foreach ($arrayAsocc as $esp => $contador) {
                array_push($count,$contador);
                $max = max($count);
            }
            $masPopularesEspecialidades = array();
            foreach ($arrayAsocc as $esp => $Contador) {
                if($Contador == $max){
                    array_push($masPopularesEspecialidades,$esp);
                }
            }
            $countPopular = count($masPopularesEspecialidades);
            $especialidad = "";
            foreach ($masPopularesEspecialidades as $key => $value) {
                if($key+1 == $countPopular){
                    $especialidad .= $value.".";
                }else{
                    $especialidad .= $value.", ";
                }
            }
            return $especialidad;
        }
        private static function MismaEspecialidad($especialidad){
            $arrayjson = Cocinero::TraerTodos('./archivos/cocinero.json');
            $masPopulares = array();
            $contadorDeEspecialidad = 0;
            foreach ($arrayjson as $objeto) {
                if ($objeto->especialidad == $especialidad) {
                    $contadorDeEspecialidad++;
                }
                array_push($masPopulares,$objeto->especialidad);
            }
            return $contadorDeEspecialidad;
        }
        public static function VerificarExistencia($email,$clave){
            $stdClass = new stdClass();
            $arrayjson = self::TraerTodos("./archivos/cocinero.json");
            $masPopulares = array();
            foreach ($arrayjson as $objeto) {
                array_push($masPopulares,$objeto->especialidad);
            }  
            foreach ($arrayjson as $value) {
                if($value->email == $email && $value->clave == $clave ){
                    $retorno = true;
                    $stdClass->exito = true;
                    $stdClass->mensaje = "Estan registrados ".Cocinero::MismaEspecialidad($value->especialidad)." cocineros con la misma especialidad";
                    break;
                }else{
                    $retorno = false;
                }
            }
            if ($retorno == false) {
                $stdClass->exito = false;
                $stdClass->mensaje = "El/los producto/os con mas apariciones es/son: ".Cocinero::MasPopularesEspecialidades($masPopulares);
            }
            
            return json_encode($stdClass);
        }

    }