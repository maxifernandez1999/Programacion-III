<?php
//CHEQUEADO
include_once("./clases/ProductoEnvasado.php");

$fotos = ProductoEnvasado::MostrarModificados();
echo "<table>";
foreach($fotos as $foto){
    echo "<tr>
        <td>
            <img src= productosModificados/$foto alt=fotoProd width=50px height=50px>
        </td>
        </tr>";
}
echo "</table>";