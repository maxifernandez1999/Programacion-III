<?php
class ClaseGenerica{
        //escribe un array de elementos de tipo texto
        public static function WriteText($nameFile,$modo,$text){
            $retorno = false;
            $archivo = fopen($nameFile,$modo);
            foreach ($text as $value) {
                if(fwrite($archivo,$value."\r\n") > 0){
                    $retorno = true;
                }else{
                    $retorno = false;
                    break;
                }
            }
            fclose($archivo);
            return $retorno;
          
        }
        //escribe sobre un archivo de texto una unica linea
        public static function WriteLineText($nameFile,$modo,$text){
            $retorno = false;
            $archivo = fopen($nameFile,$modo);
            if(fwrite($archivo,$text."\r\n") > 0){
                $retorno = true;
            }else{
                $retorno = false;
            }
            fclose($archivo);
            return $retorno;
        }

        //leer archivo de texto
        public static function Read($nameFile,$modo){
            $archivo = fopen($nameFile,$modo);
            while(!feof($archivo)){
                echo fgets($archivo).'<br>';
            }
            fclose($archivo);
        }
        //leo un archivo mientras exista el mismo,
        //sino crea el archivo de texto para su posterior escritura
        public static function FileRead($nameFile){
            if (file_exists($nameFile)) {
                if(filesize($nameFile) > 0){
                    ClaseGenerica::Read($nameFile,"r");
                }else{
                    echo 'El archivo se encuentra vacio';
                }
            }else{
                fopen($nameFile,"x+");
                echo 'Se ha creado un archivo de texto';
            }
        }
        //todo ok true si el archivo existe
        public static function FileExist($destino){
            return file_exists($destino);
        }

        //todo ok true si el archivo supera la cantidad maxima de bytes
        public static function SizeFile($keyFile,$sizeFile){
            if ($_FILES[$keyFile]["size"] > $sizeFile) {
                return true;

            }
            return false;
        }
        //todo ok true si es una imagen
        public static function IsImage($keyFile){
            $esImagen = getimagesize($_FILES[$keyFile]["tmp_name"]);
            if($esImagen > 0) {
                return true;
            }
            return false;
        }

        //todo ok true si es una extension especifica
        public static function OnlyExtensions($destino){
            $tipoArchivo = ClaseGenerica::GetPathInfo($destino);
            if($tipoArchivo != "jpg" && $tipoArchivo != "jpeg" && $tipoArchivo != "gif" && $tipoArchivo != "png") {
                return false; 
            }
            return true;
        }
        public static function GetPathInfo($destino){
            $tipoArchivo = pathinfo($destino, PATHINFO_EXTENSION);
            return $tipoArchivo;
        }

        public static function MoveUploadFile($keyFile,$destino){
            if (move_uploaded_file($_FILES[$keyFile]["tmp_name"], $destino)){
                echo "El archivo ". basename( $_FILES[$keyFile]["name"]). " ha sido subido exitosamente.";
            }else{
                echo "Lamentablemente ocurrio un error y no se pudo subir el archivo.";
            }
        }
        //subo una imagen si se cumplen las validaciones
        //SIZE
        //SI ES UNA IMAGEN
        //SI LA IMAGEN ES DE ALGUNA DE LAS EXTENSIONES DADAS
        public static function UploadImage($directory,$keyFile,$sizeFile){
            $uploadOk = true;
            $destino = $directory == "" ? $_FILES[$keyFile]["name"] : $directory."/".$_FILES[$keyFile]["name"];

            //VERIFICO QUE EL ARCHIVO NO EXISTA
            if(ClaseGenerica::FileExist($destino)){
                echo "El archivo ya existe ";
                $uploadOk = false;
            }

            //VERIFICO EL TAMAÑO MAXIMO QUE PERMITO SUBIR
            if(ClaseGenerica::SizeFile($keyFile,$sizeFile)){
                echo "La capacidad del archivo es mayor a la disponible";
                $uploadOk = false;
            }

            //OBTIENE EL TAMAÑO DE UNA IMAGEN, SI EL ARCHIVO NO ES UNA
            //IMAGEN, RETORNA FALSE
 
            if(ClaseGenerica::IsImage($keyFile) == false){
                echo "El archivo no es una imagen";
                $uploadOk = false;
            }

            //VERIFICO QUE SEAN DETERMINADAS EXTENSIONES
            if(ClaseGenerica::OnlyExtensions($destino) == false){
                echo "El archivo de texto no es de una extension permitida";
                $uploadOk = false;
            }

            //VERIFICO SI HUBO ALGUN ERROR, CHEQUEANDO $uploadOk
            if ($uploadOk === true) {
                ClaseGenerica::MoveUploadFile($keyFile,$destino);
            }else{
                echo "No se pudo subir el archivo(verifique tamaño, y si es una imagen o imagen permitida)";
            }
        }

        //copia un archivo un otra
        //retorna que sucedio 
        public static function CopyFile($origen, $destino){
            $copy = copy($origen,$destino) == true ? "Copiado" : "Fallo la copia";
            return $copy;
            
        }
        
        //elimina un archivo
        //retorna que sucedio 
        public static function DeleteFile($file){
            $delete = unlink($file) == true ? "success" : "fail";
            return $delete;
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
	            array_push($tiposArchivo,ClaseGenerica::GetPathInfo($destino));
            }
            //si un solo archivo ya existe entonces no puedo subir ninguno
            foreach($destinos as $destino){
	            if(ClaseGenerica::FileExist($destino)){
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