<?php
    include_once("clases/Empleado.php");
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : NULL;
    $clave = isset($_POST["clave"]) ? $_POST["clave"] : NULL;
    $correo = isset($_POST["correo"]) ? $_POST["correo"] : NULL;
    $id_perfil = isset($_POST["id_perfil"]) ? $_POST["id_perfil"] : NULL;
    $sueldo = isset($_POST["sueldo"]) ? $_POST["sueldo"] : NULL;
    $file = $_FILES["foto"];
    
    
    $tipoArchivo = pathinfo("./backend/empleados/fotos/".$file["name"], PATHINFO_EXTENSION);
    $foto = "./backend/empleados/fotos/".$nombre.'.'.date('His').'.'.$tipoArchivo;
    $destino = "empleados/fotos/".$nombre.'.'.date('His').'.'.$tipoArchivo;
    if (move_uploaded_file($file["tmp_name"], $destino)){
        echo "<br/>El archivo ". basename( $foto). " ha sido subido exitosamente.";
    }else{
        echo "<br/>Lamentablemente ocurri&oacute; un error y no se pudo subir el archivo.";
    }
    $empleado = new Empleado(null,$nombre,$correo,$clave,$id_perfil,null,$foto,$sueldo);
    $retorno = $empleado->Agregar() == true ? "{\"exito\":true,\"mensaje\":\"Se ha agregado al usuario correctamente\"}" : "{\"exito\":false,\"mensaje\":\"No se ha podido agregar al usuario\"}";
    echo $retorno;
?>
