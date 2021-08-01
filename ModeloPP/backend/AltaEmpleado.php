<?php
    include_once("clases/Empleado.php");
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : NULL;
    $clave = isset($_POST["clave"]) ? $_POST["clave"] : NULL;
    $correo = isset($_POST["correo"]) ? $_POST["correo"] : NULL;
    $id_perfil = isset($_POST["id_perfil"]) ? $_POST["id_perfil"] : NULL;
    $sueldo = isset($_POST["sueldo"]) ? $_POST["sueldo"] : NULL;
    $file = $_FILES["foto"];
    $stdClass = new stdClass();
    $empleadoEncontrado = false;
    $arrayEmpleados = Empleado::TraerTodos();
    foreach ($arrayEmpleados as $empleado) {
        if ($empleado->clave == $clave && $empleado->correo == $correo) {
            $empleadoEncontrado = true;
            break;
        }
    }
    $tipoArchivo = pathinfo("./backend/empleados/fotos/".$file["name"], PATHINFO_EXTENSION);
    $foto = "./backend/empleados/fotos/".$nombre.'.'.date('His').'.'.$tipoArchivo;
    $destino = "empleados/fotos/".$nombre.'.'.date('His').'.'.$tipoArchivo;
    if ($empleadoEncontrado == false) {
        if (move_uploaded_file($file["tmp_name"], $destino)){
            $empleado = new Empleado(null,$nombre,$correo,$clave,$id_perfil,null,$foto,$sueldo);
            $retorno = $empleado->Agregar() == true ? true : false;
            if ($retorno == true) {
                $stdClass->exito = true;
                $stdClass->mensaje = "Se ha agregado el empleado a la base de datos con su foto";
            }else{
                $stdClass->exito = true;
                $stdClass->mensaje = "Ocurrio un error en la consulta";
            }
        }else{
            $stdClass->exito = false;
            $stdClass->mensaje = "Ocurrio un error en el upload de la foto";
        }
    }else{
        $stdClass->exito = false;
        $stdClass->mensaje = "El empleado ya se encuentra en la base de datos"; 
    }
    
    
    echo json_encode($stdClass);
?>
