<?php
    $especialidad = isset($_GET["especialidad"]) ? $_GET["especialidad"] : NULL;
    $email = isset($_GET["email"]) ? $_GET["email"] : NULL;
    $stdClass = new stdClass();
    if (isset($_COOKIE[$email."_".$especialidad])) {
        $stdClass->exito = true;
        $stdClass->mensaje = $_COOKIE[$email."_".$especialidad];
    }else{
        $stdClass->exito = false;
        $stdClass->mensaje = "No se ha encontrado la COOKIE";
    }
    echo json_encode($stdClass);

?>