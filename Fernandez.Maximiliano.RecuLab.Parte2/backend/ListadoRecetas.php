<?php
    include_once("clases/Receta.php");
    $array = Receta::Traer();
        echo"<table align=center>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>INGREDIENTES</th>
                    <th>TIPO</th>
                    <th>FOTO</th>
                    <th>ACCIONES</th>
                </tr>";
            foreach ($array as $obj) {
                echo"<tr>
                        <td>$obj->id</td>
                        <td>$obj->nombre</td>
                        <td>$obj->ingredientes</td>
                        <td>$obj->tipo</td>
                        <td><img src='$obj->pathFoto' width='50px' height='50px'></td>
                        <td><input type='button' value='Eliminar' onclick='RecuperatorioPrimerParcial.objCocinero.EliminarReceta(".$obj->toJSON().")'><br><input type='button' value='Modificar' onclick='new RecuperatorioPrimerParcial.objCocinero.ModificarReceta(".$obj->toJSON().")'></td>
                    </tr>";
                    
            } 
        echo "</table>"; 
?>