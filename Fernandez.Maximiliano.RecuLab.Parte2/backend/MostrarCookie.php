<?php
    $especialidad = htmlspecialchars(isset($_GET["especialidad"]) ? $_GET["especialidad"] : NULL);
    $email = htmlspecialchars(isset($_GET["email"]) ? $_GET["email"] : NULL);
    $stdClass = new stdClass();
    $emailSinPunto = str_replace(".", "_" ,$email);
    if (isset($_COOKIE[$emailSinPunto."_".$especialidad])) {
        $stdClass->exito = true;
        $stdClass->mensaje = $_COOKIE[$emailSinPunto."_".$especialidad];
    }else{
        $stdClass->exito = false;
        $stdClass->mensaje = "No se ha encontrado la COOKIE";
    }
    echo json_encode($stdClass);

?>