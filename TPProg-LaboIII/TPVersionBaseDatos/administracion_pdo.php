<?php
    include_once('Persona.php');
    include_once('Empleado.php');
    include_once('Fabrica.php');
    $file = 'fotos/'.$_FILES["archivo"]["name"];
    //$arrayAsociativo = $_POST;
    
    // $nombre = '';
    // $apellido = '';
    // $dni = 0;
    // $sexo = '';
    // $legajo = 0;
    // $sueldo = 0;
    // $turno = '';
    // $hidden = '';
    // foreach ($arrayAsociativo as $key => $value) {
    //     switch ($key) {
    //         case 'txtNombre':
    //             $nombre = $value;
    //         break;
    //         case 'txtApellido':
    //             $apellido = $value;
    //         break;
    //         case 'txtDni':
    //             $dni = $value;
    //         break;
    //         case 'cboSexo':
    //             $sexo = $value;
    //         break;
    //         case 'txtLegajo':
    //             $legajo = $value;
    //         break;
    //         case 'txtSueldo':
    //             $sueldo = $value;
    //         break;
    //         case 'rdoTurno':
    //             $turno = $value;
    //         break;
    //         case 'hdnModificar':
    //             $hidden = $value;
    //         break;
    //         default:
    //             # code...
    //         break;
    //     }
        
    // }
    
    $uploadOk = true;
    if (file_exists($file)) {
        echo "El archivo ya existe. Verifique!!!";
        $uploadOk = false;
    }

    if ($_FILES["archivo"]["size"] > 1000000) {
        $uploadOk = false;
    }
    //determina si es una imagen
    $esImagen = getimagesize($_FILES["archivo"]["tmp_name"]);
    $tipoArchivo = pathinfo($file, PATHINFO_EXTENSION);
    if(!($esImagen === false)) {

	    if($tipoArchivo != "jpg" && $tipoArchivo != "bmp" && $tipoArchivo != "gif" && $tipoArchivo != "png" && $tipoArchivo != "jpeg") {
		    
		    $uploadOk = false;
	    }
    }else{
        $uploadOk = false;
    }
    if (!($uploadOk === false)) {

        $obj_json = isset($_POST['obj_json']) ? json_decode($_POST['obj_json']) : NULL;
        //MUEVO EL ARCHIVO DEL TEMPORAL AL DESTINO FINAL
        $archivoFinal = 'fotos/'.$obj_json->txtDni.'_'.$obj_json->txtApellido.'.'.$tipoArchivo;
        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivoFinal)) {
            echo "<br/>El archivo ". basename( $_FILES["archivo"]["name"]). " ha sido subido exitosamente.";

            $objFabrica = new Fabrica("Riot");
            $empleado = new Empleado($obj_json->txtNombre,
            $obj_json->txtApellido,
            $obj_json->txtDni,
            $obj_json->cboSexo,
            $obj_json->txtLegajo,
            $obj_json->txtSueldo,
            $obj_json->rdoTurno,
            $archivoFinal);
            if($objFabrica->InsertEmpleado($empleado)){
                ?>
                    <a href="mostrar.php">Volver a mostrar.php</a>
                <?php
            }else{
                ?>
                    <a href="index.html">Volver a index.html</a>
                <?php
            }
            //agrega un empleado al array de empleados
            //if($fabrica->AgregarEmpleado($empleado)){
                //$fabrica->GuardarEnArchivo('archivos/empleados.txt');
                
            //}else{
                //echo 'no se pudo guardar en el archivo de texto<br>';
                
           // }
            
            
        } else {
            echo "<br/>Lamentablemente ocurri&oacute; un error y no se pudo subir el archivo.";
        }
    
    }else{
        //echo 'Ha ocurrido un error con la subida de la imagen';
    }

    
        

    
