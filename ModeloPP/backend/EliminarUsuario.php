<?php
    include_once("clases/IBM.php");
    include_once("clases/Usuario.php");
    $id = isset($_POST["id"]) ? $_POST["id"] : NULL;
    $accion = isset($_POST["accion"]) ? $_POST["accion"]: NULL;
    $arrayUsuarios = Usuario::TraerTodos();
    $existe = false;
    $stdClass = new stdClass();
    //comprueba que el usuario a eliminar se encuentre en la BD
    foreach ($arrayUsuarios as $usuario) {
        if($usuario->id == $id){
            $existe = true;
            break;
        }
    }
    if($id!=null && $accion == "borrar"){
        if($existe == true){
            $exito = Usuario::Eliminar($id) == true ? true : false;
            if ($exito == true) {
                $stdClass->exito = true;
            $stdClass->mensaje = "Se ha eliminado el usuario";
            }else{
                $stdClass->exito = false;
                $stdClass->mensaje = "Ocurrio un error en la ejecucion";
            }
        }else{
            $stdClass->exito = false;
            $stdClass->mensaje = "El usuario a eliminar no se encuentra en la BD";
        }

    }  
    echo json_encode($stdClass);

?>