<?php
    include_once("clases/Producto.php");
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : NULL;
    $origen = isset($_POST["origen"]) ? $_POST["origen"] : NULL;
    $obj = Producto::VerificarProductoJSON($nombre,$origen);
    $objjson = json_decode($obj);
    if ($objjson->exito == true) {
        setcookie($nombre."_".$origen,date('His'));
        $objjson->mensaje;
    }else{
        $objjson->exito;
        $objjson->mensaje;
    }
    // $stdClass = new stdClass();
    // if($obj != false){
    //     $stdClass->exito = true;
    //     $stdClass->mensaje = "Se ha encontrado el usuario";
    // }else{
    //     $stdClass->exito = false;
    //     $stdClass->mensaje = "No se ha encontrado el usuario";
    // }
    echo json_encode($objjson);
?>