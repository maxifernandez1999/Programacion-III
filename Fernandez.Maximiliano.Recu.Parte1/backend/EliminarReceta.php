<?php
    // EliminarReceta.php: Si recibe un nombre por GET, retorna si la receta está en la base o no (mostrar mensaje). 
    // Si recibe por GET (sin parámetros), se mostrarán en una tabla (HTML) la información de todas las recetas 
    // borradas y sus respectivas imagenes.
    // Si recibe el parámetro receta_json (id, nombre y tipo, en formato de cadena JSON) por POST, más el parámetro 
    // accion con valor "borrar", se deberá borrar la receta (invocando al método Eliminar). 
    // Si se pudo borrar en la base de datos, invocar al método GuardarEnArchivo.
    // Retornar un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido
    include_once("clases/Receta.php");
    $recetaJSON = isset($_POST["receta_json"]) ? $_POST["receta_json"] : NULL;
    $accion = isset($_POST["accion"]) ? $_POST["accion"] : NULL;
    $nombre = isset($_GET["nombre"]) ? true : false;

    $json = json_decode($recetaJSON);

    $array = Receta::Traer();
    //obtengo ubicacion original
    foreach ($array as $obj) {
        if($obj->id == $json->id){
            $objReceta = $obj;
            break;
        }
    }


    
    $receta = new Receta($objReceta->id,$objReceta->nombre,$objReceta->ingredientes,$json->tipo,$objReceta->pathFoto);
    $stdClass = new stdClass();

    if ($recetaJSON != null && $accion == "borrar") {
        
        if ($receta->Eliminar()){
            $objjson->GuardarEnArchivo();
            $stdClass->exito = true;
            $stdClass->mensaje = "Se ha eliminado el producto";
        }else{
            $stdClass->exito = false;
            $stdClass->mensaje = "Error en el eliminado";
        }
        echo json_encode($stdClass);

    }else if($nombre == true){
        if ($receta->Existe($array)) {
            $stdClass->exito = true;
            $stdClass->mensaje = "Se encuentra en la base de datos";
        }else{
            $stdClass->exito = false;
            $stdClass->mensaje = "No se ha encontrado la receta";
        }
        echo json_encode($stdClass);
    }else{
        $array = FileRead("./archivos/recetas_borradas.txt");
        echo"<table align=center>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>INGREDIENTES</th>
                    <th>TIPO</th>
                    <th>FOTO</th>
                </tr>";
            foreach ($array as $obj) {
                echo"<tr>
                        <td>$obj->id</td>
                        <td>$obj->nombre</td>
                        <td>$obj->ingredientes</td>
                        <td>$obj->tipo</td>
                        <td><img src='$obj->pathFoto' width='50px' height='50px'></td>
                    </tr>";
                    
            } 
        echo "</table>";
    }
    
    


    function Read($nameFile,$modo){
        $arrayRecetas = array();
        $archivo = fopen($nameFile,$modo);
        while(!feof($archivo)){
            $line = fgets($archivo).'<br>';
            $lineExplode = explode('-',$line);
            $receta = new Receta($lineExplode[0],$lineExplode[1],$lineExplode[2],$lineExplode[3],$lineExplode[4]);
            array_push($arrayRecetas,$receta);
        }
        fclose($archivo);
        return $arrayRecetas;
    }
    function FileRead($nameFile){
        $array = array();
        if (file_exists($nameFile)) {
            if(filesize($nameFile) > 0){
                $array = Read($nameFile,"r");
                return $array;
            }else{
                echo 'El archivo se encuentra vacio';
            }
        }else{
            fopen($nameFile,"x+");
            echo 'Se ha creado un archivo de texto';
        }
    }

    
?>