<?php
// ListadoProductosEnvasados.php: (GET) Se mostrará el listado completo de los productos envasados (obtenidos 
// de la base de datos) en una tabla (HTML con cabecera). Invocar al método Traer. 
// Nota: Si se recibe el parámetro tabla con el valor mostrar, retornará los datos en una tabla (HTML con cabecera), 
// preparar la tabla para que muestre la imagen, si es que la tiene. 
// Si el parámetro no es pasado o no contiene el valor mostrar, retornará el array de objetos con formato JSON.

    include_once("clases/ProductoEnvasado.php");
    $array = ProductoEnvasado::Traer();
    $tabla = isset($_GET["tabla"]) ? $_GET["tabla"] : NULL;
    if (($tabla != NULL) & ($tabla == "mostrar")) {
        echo"<table align=center>
                <tr>
                    <th>NOMBRE</th>
                    <th>ORIGEN</th>
                    <th>ID</th>
                    <th>CODIGOBARRA</th>
                    <th>PRECIO</th>
                    <th>FOTO</th>
                </tr>";
            foreach ($array as $obj) {
                echo"<tr>
                        <td>$obj->nombre</td>
                        <td>$obj->origen</td>
                        <td>$obj->id</td>
                        <td>$obj->codigoBarra</td>
                        <td>$obj->precio</td>
                        <td><img src='$obj->pathFoto' width='50px' height='50px'></td>
                    </tr>";
                    
            } 
        echo "</table>";  
    }else{
        echo json_encode($array);
        
    }
?>