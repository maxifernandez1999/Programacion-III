<?php
    include_once("clases/Receta.php");
    include_once("clases/IParte1.php");
    include_once("clases/IParte2.php");
    $json = isset($_POST["receta_json"]) ? $_POST["receta_json"] : NULL;
    $file = $_FILES["foto"];
    $jsonDecode = json_decode($json);
    $stdClass = new stdClass();
    $array = Receta::Traer();

    //obtengo ubicacion original
    foreach ($array as $obj) {
        if($obj->id == $jsonDecode->id){
            $ubicacion = $obj->pathFoto;
            break;
        }
    }

    $tipoArchivoNuevo = pathinfo("./recetas/imagenes/".$file["name"], PATHINFO_EXTENSION);

    $ubicacionOriginal = "./recetas/imagenes/".$ubicacion;

    $nuevaUbicacion = "./RecetasModificadas/".$jsonDecode->nombre.'.'.$jsonDecode->tipo.'.modificado.'.date('His').'.'.$tipoArchivoNuevo;

    




    

    
    
    //$fotoName = $obj->id.'.'.$obj->nombre.'.borrado.'.date('His').'.'.$tipoArchivo;

    // Si se pudo modificar en la base de datos, la foto original del registro modificado se moverá al subdirectorio 
    // “./productosModificados/”, con el nombre formado por el nombre punto origen punto 'modificado' punto hora, 
    // minutos y segundos de la modificación (Ejemplo: aceite.italia.modificado.105905.jpg).
    // Se retornará un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.

    $obj = new Receta($jsonDecode->id,$jsonDecode->nombre,$jsonDecode->ingredientes,$jsonDecode->tipo,$jsonDecode->pathFoto);
    $exito = $obj->Modificar() == true ? true : false;
    if ($exito == true) {
        copy($ubicacionOriginal,$nuevaUbicacion);
        unlink($ubicacionOriginal);
        $stdClass->exito = true;
        $stdClass->mensaje = "Se ha modificado el producto de la BD";
    }else{
        $stdClass->exito = false;
        $stdClass->mensaje = "Error en la ejecucion de la consulta";
    }

    echo json_encode($stdClass);
    


?>