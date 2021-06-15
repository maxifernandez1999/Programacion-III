<?php

    include_once("DB_PDO.php");
    class Producto 
    {
        public $nombre;
        public $origen;
        
        public function __construct($nombre,$origen)
        {
            $this->nombre = $nombre;
            $this->origen = $origen;
            
        }
        public function GetOrigen(){
            return $this->origen;
        }
        public function GetNombre(){
            return $this->nombre;
        }
        public function toJSON(){
            //$stdClass = new stdClass();
            //$stdClass->nombre = $this->nombre;
            //$stdClass->origen = $this->origen;
            // $stdClass->clave = $this->clave;
            return json_encode($this);
            
        }
        // ./archivos/usuarios.json'
        public function GuardarJSON($path){
            $stdClass = new stdClass();
            $arrayjson = self::TraerJSON($path);
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
        public static function TraerJSON($path){//no lleva parametro
            $arrayObjetos = array();
            //$nameFile = './archivos/productos.json';
            $nameFile = $path;
            if (file_exists($nameFile)) {
                if(filesize($nameFile) > 0){
                    $archivo = fopen($nameFile,"r");
                    $contenido = fread($archivo, filesize($nameFile));
                    $array = json_decode($contenido);
                    foreach ($array as $objeto) {
                        $producto = new Producto($objeto->nombre,$objeto->origen);
                        array_push($arrayObjetos,$producto);
                    }  
                    fclose($archivo); 
                }
                    
            }
            
            return $arrayObjetos;
        }
        private static function MismoOrigen($origen){
            $arrayjson = Producto::TraerJSON('./archivos/productos.json');
            $masPopulares = array();
            $contadorDeOrigen = 0;
            foreach ($arrayjson as $objeto) {
                if ($objeto->origen == $origen) {
                    $contadorDeOrigen++;
                }
                array_push($masPopulares,$objeto->nombre);
            }
            return $contadorDeOrigen;
        }
        
        private static function MasPopulares($arrayNombres){
            $nombresMasPopulares = array();
            $arrayMasPopulares = array_count_values($arrayNombres);
            foreach ($arrayMasPopulares as $key => $contador) {
                if ($contador == max($arrayMasPopulares)) {
                    array_push($nombresMasPopulares,$key);
                }
            }
            
            // foreach ($arrayMasPopulares as $key => $contador) {
                
            //     array_push($count,$contador);
            //     $max = max($count);
            // }
            // $masPopularesNombres = array();
            // foreach ($arrayAsocc as $Nombre => $Contador) {
            //     if($Contador == $max){
            //         array_push($masPopularesNombres,$Nombre);
            //     }
            // }
            // $countPopular = count($masPopularesNombres);
            $nombres = "";
            foreach ($nombresMasPopulares as $value) {
                $nombres .= $value." - ";
            }
            return $nombres;
        }

        public static function ObtenerNombres($arrayjson){
            $arrayNombres = array();
            foreach ($arrayjson as $objeto) {
                array_push($arrayNombres,$objeto->nombre);
            } 
            return $arrayNombres;
        }
        public static function VerificarProductoJSON($nombre,$origen){//solo producto
            $arrayjson = Producto::TraerJSON('./archivos/productos.json');
            $stdClass = new stdClass();
            $retorno = true;
    
            $arrayNombres = self::ObtenerNombres($arrayjson);
            foreach ($arrayjson as $objeto) {
                if (($objeto->origen == $origen) && ($objeto->nombre == $nombre)) {
                    $retorno = true;
                    $stdClass->exito = true;
                    $stdClass->mensaje = "Estan registrados ".Producto::MismoOrigen($origen)." productos con el mismo origen";
                    break;   
                }else{
                    $retorno = false;
                }
            }
            if ($retorno == false) {
                $stdClass->exito = false;
                $stdClass->mensaje = "El/los producto/os con mas apariciones es/son: ".Producto::MasPopulares($arrayNombres);
            }
            return json_encode($stdClass);
        }
        // public function GuardarEnArchivo(){
        //     $stdClass = new stdClass();
        //     $archivo = fopen('./archivos/usuarios.json','a');
        //     $obj = json_encode($this);
        //     $retorno = fwrite($archivo,$obj."\r\n");
        //     $exito = $retorno != false ? true : false;
        //     if ($exito == true) {
        //         $stdClass->exito = true;
        //         $stdClass->mensaje = "Se pudo escribir en el archivo JSON";
        //     }else{
        //         $stdClass->exito = false;
        //         $stdClass->mensaje = "No se pudo escribir en el archivo";
        //     }
        //     fclose($archivo);
        //     return json_encode($stdClass);
        // }
        // Método de clase TraerTodosJSON(), que retornará un array de objetos de tipo Usuario, recuperado del 
        // archivo usuarios.json.
        // public static function TraerTodosJSON(){
        //     $arrayObjetosUsuario = array();
        //     $nameFile = './archivos/usuarios.json';
        //     if (file_exists($nameFile)) {
        //         if(filesize($nameFile) > 0){
        //             $archivo = fopen($nameFile,"r");
        //             while(!feof($archivo)){
        //                 $file = fgets($archivo);
        //                 if ($file != false) {
        //                     $json = json_decode($file);
        //                     $usuario = new Usuario($json->id,$json->nombre,$json->correo,$json->clave,$json->id,$json->id_perfil,$json->perfil);
        //                     array_push($arrayObjetosUsuario,$usuario);
        //                 }
                        
        //             }
        //             fclose($archivo);
        //         }
        //     }
        //     return $arrayObjetosUsuario;
        // }
        

        // public function Agregar(){//id autoincremental
        //     $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","usuarios_test");
        //     $consulta = $objPDO->RetornarConsulta("INSERT INTO usuarios (nombre, correo, clave,id_perfil) VALUES(:nombre, :correo, :clave,:id_perfil)");
        //     $consulta->bindValue(':correo', $this->correo, PDO::PARAM_STR);
        //     $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        //     $consulta->bindValue(':id_perfil', $this->id_perfil, PDO::PARAM_INT);
        //     $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        //     $success = $consulta->execute() == true ? true : false;
        //     return $success;
        // }

        // public static function TraerTodos(){
        //     $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","usuarios_test");
        //     $consulta = $objPDO->RetornarConsulta("SELECT usuarios.id,usuarios.correo, usuarios.clave, usuarios.nombre,usuarios.id_perfil, perfiles.descripcion FROM usuarios INNER JOIN perfiles ON usuarios.id_perfil = perfiles.id");
        //     $consulta->execute();
        //     $arrayObjetos = array();
        //     while($obj = $consulta->fetchObject()){
        //         $usuario = new Usuario($obj->id,$obj->nombre,$obj->correo,$obj->clave,$obj->id_perfil,$obj->descripcion);
        //         array_push($arrayObjetos,$usuario);
        //     }
        //     return $arrayObjetos;
        // }

        // public static function TraerUno($correo,$clave){//puede ser un obj o array
        //     $arrayObjetos = self::TraerTodos();
        //     $retorno = false;
        //     foreach ($arrayObjetos as $obj) {
        //         if ($obj->correo == $correo && $obj->clave == $clave) {
        //             $retorno = $obj;
        //         }
        //     }
        //     return $retorno;
        // }
        // public function Modificar(){ 
        //     $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","usuarios_test");
        //     $consulta = $objPDO->RetornarConsulta( "UPDATE usuarios SET correo = :correo, clave = :clave, nombre = :nombre, id_perfil = :id_perfil WHERE id = :id");
        //     $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
        //     $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        //     $consulta->bindValue(':correo', $this->correo, PDO::PARAM_STR);
        //     $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        //     $consulta->bindValue(':id_perfil', $this->id_perfil, PDO::PARAM_INT);
        //     $retorno = $consulta->execute() != false ? true : false;
        //     return $retorno;
        // }
        // public static function Eliminar($id){
        //     $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","usuarios_test");
        //     $consulta = $objPDO->RetornarConsulta( "DELETE FROM usuarios WHERE id = :id");
        //     $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        //     if($consulta->execute()){
        //         return true;
        //     }else{
        //         false;
        //     }
            
        // }
    }
