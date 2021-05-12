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

    if ($_FILES["archivo"]["size"] > 10000000) {
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
        $objFabrica = new Fabrica("Riot");
        $obj_json = isset($_POST['obj_json']) ? json_decode($_POST['obj_json']) : NULL;
        $existe = false;
        $consulta = $objFabrica->SelectEmpleados();
        $resultado = $consulta->fetchAll();
        if ($consulta != null) {
            $legajo = strval($obj_json->txtLegajo);
            $dni = strval($obj_json->txtDni);
            $sueldo = strval($obj_json->txtSueldo);

            foreach ($resultado as $empleado) {
                if ($empleado["legajo"] == $legajo && $empleado["nombre"] == $obj_json->txtNombre && $empleado["apellido"] == $obj_json->txtApellido && $empleado["dni"] == $dni && $empleado["sueldo"] == $sueldo && $empleado["turno"] == $obj_json->rdoTurno && $empleado["sexo"] == $obj_json->cboSexo) {
                    $existe = true;
                    break;
                }
            }
        }else{
            $existe = false;
        }
        
        //MUEVO EL ARCHIVO DEL TEMPORAL AL DESTINO FINAL
        $archivoFinal = 'fotos/'.$obj_json->txtDni.'_'.$obj_json->txtApellido.'.'.$tipoArchivo;
        if ($existe == false) {
            if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivoFinal)) {
                echo "<br/>El archivo ". basename( $_FILES["archivo"]["name"]). " ha sido subido exitosamente.";
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
            } else {
                echo "<br/>Lamentablemente ocurri&oacute; un error y no se pudo subir el archivo.";
            }
        }else{
            echo "Ya existe en la base de datos el empleado";
        }
        
    
    }else{
        echo 'Ha ocurrido un error con la subida de la imagen';
    }

    
        

    
