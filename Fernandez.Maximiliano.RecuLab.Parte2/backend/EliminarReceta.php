<?php
    // include_once("clases/Receta.php");
    // $recetaJSON = isset($_POST["receta_json"]) ? $_POST["receta_json"] : NULL;
    // $accion = isset($_POST["accion"]) ? $_POST["accion"] : NULL;
    // $nombre = isset($_GET["nombre"]) ? true : false;

    // $json = json_decode($recetaJSON);

    // $array = Receta::Traer();
    // //obtengo ubicacion original
    // foreach ($array as $obj) {
    //     if($obj->id == $json->id){
    //         $objReceta = $obj;
    //         break;
    //     }
    // }

    
    // $receta = new Receta($objReceta->id,$objReceta->nombre,$objReceta->ingredientes,$json->tipo,$objReceta->pathFoto);
    // $stdClass = new stdClass();

    // if ($recetaJSON != null && $accion == "borrar") {
        
    //     if ($receta->Eliminar()){
    //         $objjson->GuardarEnArchivo();
    //         $stdClass->exito = true;
    //         $stdClass->mensaje = "Se ha eliminado el producto";
    //     }else{
    //         $stdClass->exito = false;
    //         $stdClass->mensaje = "Error en el eliminado";
    //     }
    //     echo json_encode($stdClass);

    // }else if($nombre == true){
    //     if ($receta->Existe($array)) {
    //         $stdClass->exito = true;
    //         $stdClass->mensaje = "Se encuentra en la base de datos";
    //     }else{
    //         $stdClass->exito = false;
    //         $stdClass->mensaje = "No se ha encontrado la receta";
    //     }
    //     echo json_encode($stdClass);
    // }else{
    //     $array = FileRead("./archivos/recetas_borradas.txt");
    //     echo"<table align=center>
    //             <tr>
    //                 <th>ID</th>
    //                 <th>NOMBRE</th>
    //                 <th>INGREDIENTES</th>
    //                 <th>TIPO</th>
    //                 <th>FOTO</th>
    //             </tr>";
    //         foreach ($array as $obj) {
    //             echo"<tr>
    //                     <td>$obj->id</td>
    //                     <td>$obj->nombre</td>
    //                     <td>$obj->ingredientes</td>
    //                     <td>$obj->tipo</td>
    //                     <td><img src='$obj->pathFoto' width='50px' height='50px'></td>
    //                 </tr>";
                    
    //         } 
    //     echo "</table>";
    // }
    
    


    // function Read($nameFile,$modo){
    //     $arrayRecetas = array();
    //     $archivo = fopen($nameFile,$modo);
    //     while(!feof($archivo)){
    //         $line = fgets($archivo).'<br>';
    //         $lineExplode = explode('-',$line);
    //         $receta = new Receta($lineExplode[0],$lineExplode[1],$lineExplode[2],$lineExplode[3],$lineExplode[4]);
    //         array_push($arrayRecetas,$receta);
    //     }
    //     fclose($archivo);
    //     return $arrayRecetas;
    // }
    // function FileRead($nameFile){
    //     $array = array();
    //     if (file_exists($nameFile)) {
    //         if(filesize($nameFile) > 0){
    //             $array = Read($nameFile,"r");
    //             return $array;
    //         }else{
    //             echo 'El archivo se encuentra vacio';
    //         }
    //     }else{
    //         fopen($nameFile,"x+");
    //         echo 'Se ha creado un archivo de texto';
    //     }
    // }

    require_once('clases/Receta.php');

    $auxNombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;

    $recetaJSON = isset($_POST['receta_json']) ? $_POST['receta_json'] : null;
    $accion =  isset($_POST['accion']) ? $_POST['accion'] : null;
    //SI RECIBIO LA RECETA POR POST
    if($recetaJSON != null && $accion === 'borrar')
    {
        $stdClass = new stdClass();
        $recetaDecodificada = json_decode($recetaJSON);
        //ubico la receta a eliminar 
        $objReceta = "";
        $arrayRecetas = Receta::Traer();
        foreach ($arrayRecetas as $receta)
        {
            //$recetaint = intval($receta->id);
            if ($receta->id == $recetaDecodificada->id)
            {
                //instancio la receta auxiliar con los datos de la receta encontrada en la Base de Datos
                $objReceta = $receta;
            }
        }

        if($objReceta->Eliminar())
        {
            $stdClass->exito = true;
            $stdClass->mensaje = "Se ha Eliminado de la base pero no se ha guardado el archivo.";
//////////////
            $rtaGuardarArchivo = $objReceta->GuardarEnArchivo();
            $rtaDecodificada = json_decode($rtaGuardarArchivo);

            if($rtaDecodificada->exito == true)
            { 
                $stdClass->mensaje = "Se ha Eliminado y {$rtaDecodificada->mensaje}";
            }else{
                $stdClass->mensaje = "{$rtaDecodificada->mensaje}";
            }
        }else{
            $stdClass->mensaje = "NO SE PUDO ELIMINAR LA RECETA";
        }

        echo json_encode($stdClass);
    }
    // SI RECIBE NOMBRE POR GET 
    else if($auxNombre != null){
        
        $nombreEncontrado = false;
        $array = Receta::Traer();
        foreach($array as $receta)
        {
            if($receta->nombre === $auxNombre )
            {
                $nombreEncontrado = true;
                break;
            }
        }

        if ($nombreEncontrado)
        {
            echo 'Se ha encontrado la Receta';
        }else{
            echo  'NO SE ENCONTRO!!  la Receta';
        }
    }
    // NO RECIBIO NADA POR POST NI POR GET 
    else{
        $arrayRecetasBorrada = array();
        $path = 'archivos/recetas_borradas.txt';
        $archivoOpen = fopen($path,'r');

        if($archivoOpen)
        {
            
            while(!feof($archivoOpen))
            {
                $lineaObtenida = fgets($archivoOpen);

                if($lineaObtenida!=false)
                {
                    $recetaFile = explode('',$lineaObtenida);
                    array_push($arrayRecetasBorrada,new Receta($recetaFile[0],$recetaFile[1],$recetaFile[2],$recetaFile[3],$recetaFile[4]));            
                }
            }
            fclose($archivoOpen);
        }
        if(count($arrayRecetasBorrada)>0 )
        {
            $tablaHtml= "
            <table style='border: 2px solid black;text-align:center'>
            <caption>RECETAS BORRADAS</caption>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>INGREDIENTES</th>
            <th>TIPO</th>
            <th>FOTO</th>";

            foreach($arrayRecetasBorrada as $recetaArray)
            {  
                $tablaHtml .=
                "<tr style='text-align:center'>
                <td> {$recetaArray->id} <td>
                <td>{$recetaArray->nombre}</td>
                <td>{$recetaArray->ingredientes}</td>
                <td>{$recetaArray->tipo}</td>";
                if($recetaArray->pathFoto != null)
                {
                    $tablaHtml .= "<td> <img src='recerasBorradas/{$recetaArray->pathFoto}' alt='imgRecetaBorrada' width='50px'>  </td>";
                }else{
                    $tablaHtml .= "<td> Sin foto.  </td>";
                }
            }
            $tablaHtml.= "</tr> </table>";

            echo $tablaHtml;
        }else{
            echo 'NO HAY RECETAS BORRADAS';
        }
    }

    
?>