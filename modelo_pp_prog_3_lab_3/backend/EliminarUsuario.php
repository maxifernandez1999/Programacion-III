<?php
    include_once("clases/IBM.php");
    include_once("clases/Usuario.php");
    $id = isset($_POST["id"]) ? $_POST["id"] : NULL;
    $accion = isset($_POST["accion"]) ? $_POST["accion"]: NULL;
    $arrayUsuarios = Usuario::TraerTodos();
    $existe = false;
    
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
                echo "{\"exito\":true,\"mensaje\":\"Se ha eliminado el usuario\"}";
            }else{
                echo "Ha ocurrido un error con la consulta";
            }
        }else{
            echo "{\"exito\":false,\"mensaje\":\"No se ha podido eliminar el usuario\"}";
        }

    }  

?>