<?php
class Archivos
{
        
        
        public static function UploadMultipleImages($directory,$keyFile,$sizeFile){
            $uploadOk = true;
            //OBTENGO TODOS LOS NOMBRES DE LOS ARCHIVOS
            $nombres = $_FILES[$keyFile]["name"];
            $sizes = $_FILES[$keyFile]["size"];

            //INDICO CUALES SERAN LOS DESTINOS DE LOS ARCHIVOS SUBIDOS Y SUS TIPOS
            $destinos = array();
            $tiposArchivo = array();
            foreach($nombres as $nombre){
                $destino = $directory == "" ? $nombre : $directory."/".$nombre;
	            array_push($destinos, $destino);
	            array_push($tiposArchivo, pathinfo($destino, PATHINFO_EXTENSION));
            }
            //si un solo archivo ya existe entonces no puedo subir ninguno
            foreach($destinos as $destino){
	            if (file_exists($destino)) {
		            $uploadOk = false;
		            break;
	            }
            }
            //verifico el size de todos los archivos
            foreach($sizes as $size){
	            if ($size > $sizeFile) {
		            $uploadOk = false;
		            break;
	            }
            }
            //comprueba si todos son imagenes
            $tmpsNames = $_FILES[$keyFile]["tmp_name"];
            $i=0;
            foreach($tmpsNames as $tmpName){
	            $esImagen = getimagesize($tmpName);
	            if($esImagen === true){ 
                    if($tiposArchivo[$i] != "jpg" && $tiposArchivo[$i] !=   "jpeg" && $tiposArchivo[$i] != "gif"
                    && $tiposArchivo[$i] != "png") {
                        $uploadOk = false;
                        break;
		            }
                    $i++;
	            }
	        
            }

            if ($uploadOk === true) {
                for($i=0;$i<count($tmpsNames);$i++){
                    if (move_uploaded_file($tmpsNames[$i], $destinos[$i])) {
                        echo "El archivo ". basename( $tmpsNames[$i]). " ha sido subido exitosamente.";
                    }else{
                        echo "Lamentablemente ocurrio un error y no se pudo subir el archivo ". basename( $tmpsNames[$i]).".";
                    }
                }
            }else{
	            echo "No se pudieron subir los archivo(verifique tamaño, y si es una imagen o imagen permitida)";
            }
        }
}

?>