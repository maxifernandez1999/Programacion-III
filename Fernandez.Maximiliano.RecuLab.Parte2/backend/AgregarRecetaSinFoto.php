<?php
    include_once("clases/Receta.php");
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : NULL;
    $ingredientes = isset($_POST["ingredientes"]) ? $_POST["ingredientes"] : NULL;
    $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : NULL;
    $stdClass = new stdClass();
    
    $receta = new Receta(null,$nombre,$ingredientes,$tipo,null);
    
    if ($receta->Agregar()) {
        $stdClass->exito = true;
        $stdClass->mensaje = "Se ha agregado la receta a la base de datos sin foto";
    }else{
        $stdClass->exito = false;
        $stdClass->mensaje = "Ocurrio un error en la consulta";
    }

    
    
    echo json_encode($stdClass);
?>