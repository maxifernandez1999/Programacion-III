<?php
    include_once("clases/Televisor.php");
    $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : NULL;
    $precio = isset($_POST["precio"]) ? $_POST["precio"] : NULL;
    $paisOrigen = isset($_POST["paisOrigen"]) ? $_POST["paisOrigen"] : NULL;
    $televisor = new Televisor($tipo,$precio,$paisOrigen);
    $arrayTelevisores = $televisor->Traer();
    if($televisor->Verificar($arrayTelevisores)){
        echo "Ya existe en al base de datos";
    }else{
        $televisor->Agregar();
    }

?>