<?php
    $nombre = isset($_GET["nombre"]) ? $_GET["nombre"] : NULL;
    $origen = isset($_GET["origen"]) ? $_GET["origen"] : NULL;
    $stdClass = new stdClass();
    if (isset($_COOKIE[$nombre."_".$origen])) {
        $stdClass->exito = true;
        $stdClass->mensaje = $_COOKIE[$nombre."_".$origen];
    }else{
        $stdClass->exito = false;
        $stdClass->mensaje = "No se ha encontrado la COOKIE";
        //setcookie("pepe_australia","",time()-3600);
    }
    echo json_encode($stdClass);

?>