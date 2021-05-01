<?php
    include_once("clases/Usuario.php");
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : NULL;
    $clave = isset($_POST["clave"]) ? $_POST["clave"] : NULL;
    $correo = isset($_POST["correo"]) ? $_POST["correo"] : NULL;
    $id_perfil = isset($_POST["id_perfil"]) ? $_POST["id_perfil"] : NULL;
    $usuarioBD = Usuario::TraerUno($correo, $clave);
    if ($usuarioBD == false) {
        $usuario = new Usuario(null,$nombre,$correo,$clave,$id_perfil,null);
        $retorno = $usuario->Agregar() == true ? "{\"exito\":true,\"mensaje\":\"Se ha agregado al usuario correctamente\"}" : "Ocurrio un error con la consulta a la base de datos";
    }else{
        $retorno = "{\"exito\":false,\"mensaje\":\"No se ha podido agregar al usuario\"}";
    }

    
    echo $retorno;

?>