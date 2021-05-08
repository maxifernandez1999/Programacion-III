<?php
    include_once("clases/ProductoEnvasado.php");
    include_once("clases/IParte1.php");
    include_once("clases/IParte2.php");
    include_once("clases/IParte3.php");
    $json = isset($_POST["producto_json"]) ? $_POST["producto_json"] : NULL;
    $jsonDecode = json_decode($json);
    $stdClass = new stdClass();
    $array = ProductoEnvasado::Traer();
    $existe = false;
    //compruebo si el producto a modificar existe
    foreach ($array as $obj) {
        if($obj->id == $jsonDecode->id){
            $existe = true;
            $ubicacion = $obj->pathFoto;
            break;
        }
    }
    
    $tipoArchivo = pathinfo("productos/imagenes".$ubicacion, PATHINFO_EXTENSION);
    $ubicacionOriginal = "productos/imagenes/".$ubicacion;
    $nuevaubicacion = "productosModificados/".$obj->nombre.'.'.$obj->origen.'.modificado.'.date('His').'.'.$tipoArchivo;
    $fotoName = $obj->id.'.'.$obj->nombre.'.borrado.'.date('His').'.'.$tipoArchivo;

    // Si se pudo modificar en la base de datos, la foto original del registro modificado se moverá al subdirectorio 
    // “./productosModificados/”, con el nombre formado por el nombre punto origen punto 'modificado' punto hora, 
    // minutos y segundos de la modificación (Ejemplo: aceite.italia.modificado.105905.jpg).
    // Se retornará un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.

    if ($existe == true) {  
            $obj = new ProductoEnvasado($jsonDecode->nombre,$jsonDecode->origen,$jsonDecode->id,$jsonDecode->codigoBarra,$jsonDecode->precio,$nuevaubicacion);
            $exito = $obj->Modificar() == true ? true : false;
            if ($exito == true) {
                copy($ubicacionOriginal,$nuevaubicacion);
                unlink($ubicacionOriginal);
                $stdClass->exito = true;
                $stdClass->mensaje = "Se ha modificado el producto de la BD";
            }else{
                $stdClass->exito = false;
                $stdClass->mensaje = "Error en la ejecucion de la consulta";
            }
    }else{
        $stdClass->exito = false;
        $stdClass->mensaje = "El producto que desea modificar no se encuentra en la base de datos";
    }    

    echo json_encode($stdClass);
    


?>