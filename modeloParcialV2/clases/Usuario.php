<?php
    class Usuario{

        private $email;
        private $clave;
        
        public function __construct($email,$clave)
        {
            $this->email = $email;
            $this->clave = $clave;
            
        }
        public function toString(){
            
            return $this->email."-".$this->clave;
            
        }
        public function GuardarEnArchivo(){
            $retorno = false;
            $archivo = fopen("./archivos/usuarios.txt","a");
            if(fwrite($archivo,$this->toString()."\r\n") > 0){
                $retorno = "ok";
            }else{
                $retorno = "error";
            }
            fclose($archivo);
            return $retorno;
        }
        public static function Read(){
            $usuarios = array();
            $archivo = fopen("./archivos/usuarios.txt","r");
            while(!feof($archivo)){
                array_push($usuarios,fgets($archivo));
            }
            fclose($archivo);
            return $usuarios;
        }
        //leo un archivo mientras exista el mismo,
        //sino crea el archivo de texto para su posterior escritura
        public static function TraerTodos(){
            if (file_exists("./archivos/usuarios.txt")) {
                if(filesize("./archivos/usuarios.txt") > 0){
                    $usuarios = self::Read();
                }else{
                    echo 'El archivo se encuentra vacio';
                }
            }else{
                fopen("./archivos/usuarios.txt","x+");
                echo 'Se ha creado un archivo de texto';
            }
            return $usuarios;
        }

        public static function VerificarExistencia($usuario){
            $users = self::TraerTodos();
            foreach ($users as $user) {
                if ($user == $usuario) {
                    $retorno = true;
                    break;
                }else{
                    $retorno = false;
                }
            }
            return $retorno;
        }
    }

?>