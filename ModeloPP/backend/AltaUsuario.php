<?php
    include_once("clases/Usuario.php");
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : NULL;
    $clave = isset($_POST["clave"]) ? $_POST["clave"] : NULL;
    $correo = isset($_POST["correo"]) ? $_POST["correo"] : NULL;
    $id_perfil = isset($_POST["id_perfil"]) ? $_POST["id_perfil"] : NULL;
    $usuarioBD = Usuario::TraerUno($correo, $clave);
    $stdClass = new stdClass();
    if ($usuarioBD == false) {
        $usuario = new Usuario(null,$nombre,$correo,$clave,$id_perfil,null);
        if($usuario->Agregar()){
            $stdClass->exito = true;
            $stdClass->mensaje = "Se ha agregado al usuario a la base de datos";
        }else{
            $stdClass->exito = false;
            $stdClass->mensaje = "Ha ocurrido un error en la consulta";
        }
    }else{
        $stdClass->exito = false;
        $stdClass->mensaje = "No se ha podido agregar al usuario a la base de datos";
    }
    echo json_encode($stdClass);

?>