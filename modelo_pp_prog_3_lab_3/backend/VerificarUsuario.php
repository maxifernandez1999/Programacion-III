<?php
    include_once("clases/Usuario.php");
    $objJSON = isset($_POST["usuario_json"]) ? $_POST["usuario_json"] : NULL;
    $objDecode = json_decode($objJSON);
    $obj = Usuario::TraerUno($objDecode->correo,$objDecode->clave);
    if($obj != false){
        echo "{\"exito\":true,\"mensaje\":\"Se ha encontrado el usuario\"}";
    }else{
        echo "{\"exito\":false,\"mensaje\":\"No se ha encontrado el usuario\"}";
    }
?>