<?php
    include_once('Persona.php');
    include_once('Empleado.php');
    include_once('Fabrica.php');

    $file = '../fotos/'.$_FILES["archivo"]["name"];

    $objFabrica = new Fabrica("Riot");

    $obj_json = isset($_POST['obj_json']) ? json_decode($_POST['obj_json']) : NULL;

    $tipoArchivo = pathinfo($file, PATHINFO_EXTENSION);

    $archivoFinal = '../fotos/'.$obj_json->txtDni.'_'.$obj_json->txtApellido.'.'.$tipoArchivo;

    function ValidacionArchivo($file,$archivoFinal,$tipoArchivo){
        $uploadOk = true;
        if ($_FILES["archivo"]["size"] > 10000000) {
            $uploadOk = false;
        }
        //determina si es una imagen
        $esImagen = getimagesize($_FILES["archivo"]["tmp_name"]);
        
        if(!($esImagen === false)) {
            if (file_exists($archivoFinal)) {
                echo "La imagen ya existe en el listado de empleados";
                $uploadOk = false;
            }
            if($tipoArchivo != "jpg" && $tipoArchivo != "bmp" && $tipoArchivo != "gif" && $tipoArchivo != "png" && $tipoArchivo != "jpeg") {
                echo "La imagen seleccinada no tiene la extension permitida. Extensiones permitidas: .jpg / .bmp / .gif / .png / .jpeg";
                $uploadOk = false;
            }   
        }else{
            echo "El archivo seleccionado no es una imagen";
            $uploadOk = false;
        }
        return $uploadOk;
    }
    
    //VERIFICO LA EXISTENCIA DEL EMPLEADO, DESPUES DE VALIDAR EL ARCHIVO
    if (ValidacionArchivo($file,$archivoFinal,$tipoArchivo) === true) {
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
        
        if ($existe == false) {
            if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivoFinal)) {
                echo "El archivo ". basename( $_FILES["archivo"]["name"]). " ha sido subido exitosamente.";
                $empleado = new Empleado($obj_json->txtNombre,
                $obj_json->txtApellido,
                $obj_json->txtDni,
                $obj_json->cboSexo,
                $obj_json->txtLegajo,
                $obj_json->txtSueldo,
                $obj_json->rdoTurno,
                $archivoFinal);
                if($objFabrica->InsertEmpleado($empleado)){
                    echo "Empleado agregado exitosamente a la Base de Datos";
                }else{
                    echo "Ocurrio un error al agregar el nuevo empleado a la Base de Datos";
                }     
            }else{
                echo "Lamentablemente ocurrio un error y no se pudo subir correctamente";
            }
        }else{
            echo "Ya existe el empleado en la Base de Datos";
        }
        
    
    }else{
        echo '<br>Ha ocurrido un error la imagen. Verifique que cumpla con las condiciones especificadas';
    }

    
        

    
