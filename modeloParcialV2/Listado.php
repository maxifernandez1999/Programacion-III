<?php


    include_once("clases/Televisor.php");
    $televisor = new Televisor();
    $array = $televisor->Traer();
    $tabla = isset($_GET["tabla"]) ? $_GET["tabla"] : NULL;
    if (($tabla != NULL) & ($tabla == "mostrar")) {
        echo"<table align=center>
                <tr>
                    <th>TIPO</th>
                    <th>PRECIO</th>
                    <th>PAIS</th>
                    <th>PATHFOTO</th>
                    <th>IVAINCLUIDO<th>
                </tr>";
            foreach ($array as $obj) {
                echo"<tr>
                        <td>$obj->tipo</td>
                        <td>$obj->precio</td>
                        <td>$obj->pais</td>
                        <td>$obj->path</td>
                        <td>$obj->CalcularIVA()</td>
                    </tr>";
                    
            } 
        echo "</table>";  
    }else{
        echo json_encode($array);
        
    }
?>