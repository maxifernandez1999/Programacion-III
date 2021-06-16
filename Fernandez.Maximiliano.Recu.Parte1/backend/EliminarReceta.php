<?php
    
    include_once("clases/Receta.php");
    $jsonx = isset($_POST["productos_json"]) ? $_POST["productos_json"] : NULL;
    $json = json_decode($jsonx);
    $array = ProductoEnvasado::Traer();
    $stdClass = new stdClass();
    $existe = false;
    $objjson = null;
    if($existe == true){
        $exito = ProductoEnvasado::Eliminar($obj->id) == true ? true : false;
        if ($exito == true) {
            $objjson->GuardarJSON('./archivos/productos_eliminados.json');
            $stdClass->exito = true;
            $stdClass->mensaje = "Se ha eliminado el producto";
        }else{
            $stdClass->exito = false;
            $stdClass->mensaje = "Error en la ejecucion de la consulta";
        }
    }else{
        $stdClass->exito = false;
        $stdClass->mensaje = "No se ha encontrado el producto a eliminar en la BD";
    }
    echo json_encode($stdClass);

?>