<?php
class Archivos
{
        private $nameFile;
        private $modo;

        public static function WriteFile($nameFile,$modo,$text = null,$arrayText = null){

            $archivo = fopen($nameFile,$modo);
            if ($arrayText != null) {
                foreach ($arrayText as $value) {
                    fwrite($archivo,$value."\r\n");
                }
            }
            if ($text != null) {
                fwrite($archivo,$text."\r\n");
            }
            fclose($archivo);
        }
    
        public static function FileRead($nameFile){
            if (file_exists($nameFile)) {
                if(filesize($nameFile) > 0){
                    $archivo = fopen($nameFile,"r");
                    while(!feof($archivo)){
                        echo fgets($archivo).'<br>';
                    }
                    fclose($archivo);
                }else{
                    echo 'El archivo se encuentra vacio';
                }
            }else{
                $archivo = fopen($nameFile,"x+");
                fclose($archivo);
                echo 'Se ha creado un archivo de texto';
            }
        }
}

?>