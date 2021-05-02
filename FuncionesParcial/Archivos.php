<?php
class Archivos
{
        //escribe sobre un archivo de texto
        //si es una cadena, escribo en la primer linea
        //si es un array, escribo cada elemento en lineas distintas
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
        //leo un archivo mientras exista el mismo,
        //sino crea el archivo de texto para su posterior escritura
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
        //subo una imagen si se cumplen las validaciones
        //SIZE
        //SI ES UNA IMAGEN
        //SI LA IMAGEN ES DE ALGUNA DE LAS EXTENSIONES DADAS
        public static function UploadImage($directory,$keyFile,$sizeFile){
            $uploadOk = true;
            $destino = $directory == "" ? $_FILES[$keyFile]["name"] : $directory."/".$_FILES[$keyFile]["name"];
            $tipoArchivo = pathinfo($destino, PATHINFO_EXTENSION);

            //VERIFICO QUE EL ARCHIVO NO EXISTA
            if (file_exists($destino)) {
                $uploadOk = false;
            }
            //VERIFICO EL TAMAÑO MAXIMO QUE PERMITO SUBIR
            if ($_FILES[$keyFile]["size"] > $sizeFile) {
                $uploadOk = false;
            }

            //OBTIENE EL TAMAÑO DE UNA IMAGEN, SI EL ARCHIVO NO ES UNA
            //IMAGEN, RETORNA FALSE
            $esImagen = getimagesize($_FILES[$keyFile]["tmp_name"]);
            if($esImagen === false) {
                $uploadOk = false;
            }else{
                //SOLO PERMITO CIERTAS EXTENSIONES
                if($tipoArchivo != "jpg" && $tipoArchivo != "jpeg" && $tipoArchivo != "gif"
                && $tipoArchivo != "png") {
                    $uploadOk = false;
                }
            }
            //VERIFICO SI HUBO ALGUN ERROR, CHEQUEANDO $uploadOk
            if ($uploadOk === true) {
                if (move_uploaded_file($_FILES[$keyFile]["tmp_name"], $destino)){
                    echo "El archivo ". basename( $_FILES[$keyFile]["name"]). " ha sido subido exitosamente.";
                }else{
                    echo "Lamentablemente ocurrio un error y no se pudo subir el archivo.";
                }
            }else{
                echo "No se pudo subir el archivo(verifique tamaño, y si es una imagen o imagen permitida)";
            }
        }
        //copia un archivo un otra
        //retorna que sucedio 
        public static function CopyFile($origen, $destino){
            $copy = copy($origen,$destino) == true ? "Copiado" : "Fallo la copia";
            
        }
        
        //elimina un archivo
        //retorna que sucedio 
        public static function DeleteFile($file){
            $delete = unlink($file) == true ? "success" : "fail";
        }
        
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