<?php
class Archivos
{
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

        public static function UploadImage($directory,$keyFile,$sizeFile){
            $uploadOk = true;
            $destino = $directory == "" ? $_FILES[$keyFile]["name"] : $directory."/".$_FILES[$keyFile]["name"];
            $tipoArchivo = pathinfo($destino, PATHINFO_EXTENSION);

            //VERIFICO QUE EL ARCHIVO NO EXISTA
            if (file_exists($destino)) {
                echo "El archivo ya existe. Verifique!!!";
                $uploadOk = false;
            }
            //VERIFICO EL TAMAÑO MAXIMO QUE PERMITO SUBIR
            if ($_FILES[$keyFile]["size"] > $sizeFile) {
                echo "El archivo es demasiado grande. Verifique!!!";
                $uploadOk = false;
            }

            //OBTIENE EL TAMAÑO DE UNA IMAGEN, SI EL ARCHIVO NO ES UNA
            //IMAGEN, RETORNA FALSE
            $esImagen = getimagesize($_FILES[$keyFile]["tmp_name"]);
            if($esImagen === false) {
                echo "El archivo no es una imagen";
            }else{
                //SOLO PERMITO CIERTAS EXTENSIONES
                if($tipoArchivo != "jpg" && $tipoArchivo != "jpeg" && $tipoArchivo != "gif"
                && $tipoArchivo != "png") {
                echo "Solo son permitidas imagenes con extension JPG, JPEG, PNG o GIF.";
                $uploadOk = false;
                }
            }
            //VERIFICO SI HUBO ALGUN ERROR, CHEQUEANDO $uploadOk
            if ($uploadOk === true) {
                if (move_uploaded_file($_FILES[$keyFile]["tmp_name"], $destino)){
                    echo "<br/>El archivo ". basename( $_FILES[$keyFile]["name"]). " ha sido subido exitosamente.";
                }else{
                    echo "<br/>Lamentablemente ocurri&oacute; un error y no se pudo subir el archivo.";
                }
            }else{
                echo "<br/>NO SE PUDO SUBIR EL ARCHIVO.";
            }
        }

        public static function CopyFile($origen, $destino){
            $copy = copy($origen,$destino) == true ? "Copiado" : "Fallo la copia";
            
        }
        

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
            
            foreach($destinos as $destino){
	            if (file_exists($destino)) {
		            echo "El archivo {$destino} ya existe. Verifique!!!";
		            $uploadOk = false;
		            break;
	            }
            }
            foreach($sizes as $size){
	            if ($size > $sizeFile) {
		            echo "Archivo demasiado grande. Verifique!!!";
		            $uploadOk = false;
		            break;
	            }
            }

            $tmpsNames = $_FILES[$keyFile]["tmp_name"];
            $i=0;
            foreach($tmpsNames as $tmpName){
	            $esImagen = getimagesize($tmpName);
	            if($esImagen === true){ 
                    if($tiposArchivo[$i] != "jpg" && $tiposArchivo[$i] !=   "jpeg" && $tiposArchivo[$i] != "gif"
                    && $tiposArchivo[$i] != "png") {
                        echo "Solo son permitidas imagenes con extension JPG, JPEG, PNG o GIF.";
                        $uploadOk = false;
                        break;
		            }
                    $i++;
	            }
	        
            }

            if ($uploadOk === true) {
                for($i=0;$i<count($tmpsNames);$i++){
                    if (move_uploaded_file($tmpsNames[$i], $destinos[$i])) {
                        echo "<br/>El archivo ". basename( $tmpsNames[$i]). " ha sido subido exitosamente.";
                    }else{
                        echo "<br/>Lamentablemente ocurri&oacute; un error y no se pudo subir el archivo ". basename( $tmpsNames[$i]).".";
                    }
                }
            }else{
	            echo "<br/>NO SE PUDIERON SUBIR LOS ARCHIVOS.";
            }
        }
}

?>