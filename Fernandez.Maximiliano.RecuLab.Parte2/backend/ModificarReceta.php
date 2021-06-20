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
            $objOriginal = $obj;
            break;
        }
    }

    $tipoArchivoNuevo = pathinfo("./recetas/imagenes/".$file["name"], PATHINFO_EXTENSION);

    $fotoName = $jsonDecode->nombre.'.'.$jsonDecode->tipo.'.'.date('His').'.'.$tipoArchivoNuevo;

    $nuevaUbicacion = "./recetas/imagenes/".$jsonDecode->nombre.'.'.$jsonDecode->tipo.'.'.date('His').'.'.$tipoArchivoNuevo;

    $tipoArchivoAntiguo = pathinfo("./recetas/imagenes/".$objOriginal->pathFoto, PATHINFO_EXTENSION);

    $ubicacionOriginal = "./recetas/imagenes/".$objOriginal->pathFoto;
    
    $nuevaUbicacionModificado = "./recetas/recetasModificadas/".$objOriginal->nombre.'.'.$objOriginal->tipo.".modificado.".date('His').'.'.$tipoArchivoAntiguo;

    

    $obj = new Receta($jsonDecode->id,$jsonDecode->nombre,$jsonDecode->ingredientes,$jsonDecode->tipo,$fotoName);

    if ($obj->Modificar()){
        copy($ubicacionOriginal,$nuevaUbicacionModificado);
        unlink($ubicacionOriginal);
        if(move_uploaded_file($file["tmp_name"], $nuevaUbicacion)){
            $stdClass->exito = true;
            $stdClass->mensaje = "Se ha modificado el producto de la BD y  guardado el nuevo archivo";
        }else{
            $stdClass->exito = false;
            $stdClass->mensaje = "Error con el archivo nuevo";
        }
        
    }else{
        $stdClass->exito = false;
        $stdClass->mensaje = "Error en la ejecucion de la consulta";
    }

    echo json_encode($stdClass);
    


?>