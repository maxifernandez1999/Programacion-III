<?php
    include_once("clases/Usuario.php");
    $objJSON = isset($_POST["usuario_json"]) ? $_POST["usuario_json"] : NULL;
    $objDecode = json_decode($objJSON);
    $obj = Usuario::TraerUno($objDecode->correo,$objDecode->clave);
    $stdClass = new stdClass();
    if($obj != false){
        $stdClass->exito = true;
        $stdClass->mensaje = "Se ha encontrado el usuario";
    }else{
        $stdClass->exito = false;
        $stdClass->mensaje = "No se ha encontrado el usuario";
    }
    echo json_encode($stdClass);
?>