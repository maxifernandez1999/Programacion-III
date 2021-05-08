<?php
    
    include_once("clases/ProductoEnvasado.php");
    include_once("clases/Producto.php");
    // include_once("clases/IParte1.php");
    // include_once("clases/IParte2.php");
    // include_once("clases/IParte3.php");
    $jsonx = isset($_POST["productos_json"]) ? $_POST["productos_json"] : NULL;
    $json = json_decode($jsonx);
    $array = ProductoEnvasado::Traer();
    $stdClass = new stdClass();
    $existe = false;
    $objjson = null;
    foreach ($array as $obj) {
        if($obj->id == $json->id){
            $existe = true;
            $objjson = $obj;
            break;
        }
    }
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