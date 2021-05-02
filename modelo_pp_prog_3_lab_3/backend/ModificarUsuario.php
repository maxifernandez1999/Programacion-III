<?php
    include_once("clases/IBM.php");
    include_once("clases/Usuario.php");
    $json = isset($_POST["usuario_json"]) ? $_POST["usuario_json"] : NULL;
    $jsonDecode = json_decode($json);
    $arrayUsuarios = Usuario::TraerTodos();
    $existe = false;
    $stdClass = new stdClass();
    //comprueba si existe el usuario a modificar
    foreach ($arrayUsuarios as $usuario) {
        if($usuario->id == $jsonDecode->id){
            $existe = true;
            $obj = new Usuario($jsonDecode->id,$jsonDecode->nombre,$jsonDecode->correo,$jsonDecode->clave,$jsonDecode->id_perfil,null);
            break;
        }
    }
    if ($existe == true) {  
        $exito = $obj->Modificar() == true ? true : false;
        if ($exito == true) {
            $stdClass->exito = true;
            $stdClass->mensaje = "Se ha modificado el usuario";
        }else{
            $stdClass->exito = true;
            $stdClass->mensaje = "Error en la ejecucion de la consulta";
        }
    }else{
        $stdClass->exito = false;
        $stdClass->mensaje = "El usuario a modificar no existe en la base de datos";
    }
    echo json_encode($stdClass);

?>