<?php
    include_once("clases/IBM.php");
    include_once("clases/Usuario.php");
    $json = isset($_POST["usuario_json"]) ? $_POST["usuario_json"] : NULL;
    $jsonDecode = json_decode($json);
    $arrayUsuarios = Usuario::TraerTodos();
    $existe = false;
    foreach ($arrayUsuarios as $usuario) {
        if($usuario->id == $jsonDecode->id){
            $existe = true;
            $obj = new Usuario($jsonDecode->id,$jsonDecode->nombre,$jsonDecode->correo,$jsonDecode->clave,$jsonDecode->id_perfil,null);
            break;
        }
    }
    if ($existe == true) {  
        $exito = $obj->Modificar($json) == true ? true : false;
        if ($exito == true) {
            echo "{\"exito\":$exito,\"mensaje\":\"Se ha modificado el usuario\"}";
        }else{
            echo "Error en la ejecucion de la consulta";
        }
    }else{
        echo "{\"exito\":$existe,\"mensaje\":\"No se ha podido modificar el usuario\"}";
    }
    
    
    //{"id":10,"correo":"maxi@maxi.com","clave":"11234","nombre":"maxi","id_perfil":1}

?>