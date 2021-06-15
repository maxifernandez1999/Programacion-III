<?php
//CHEQUEADO
include_once("./clases/ProductoEnvasado.php");

$origen = isset($_POST['origen']) ? $_POST['origen'] : '';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';

$productos = ProductoEnvasado::Traer();
$arrayFiltrado = [];

if($origen != '' && $nombre == '')
{
    foreach($productos as $producto)
    {
        if($origen == $producto->origen)
        {
            array_push($arrayFiltrado, $producto);
        }
    }
}
else if($nombre != '' && $origen == '')
{
    foreach($productos as $producto)
    {
        if($nombre == $producto->nombre)
        {
            array_push($arrayFiltrado, $producto);
        }
    }
}
else if($nombre != '' && $origen != '')
{
    foreach($productos as $producto)
    {
        if($origen == $producto->origen && $nombre == $producto->nombre)
        {
            array_push($arrayFiltrado, $producto);
        }
    }
}

echo "<table>
        <tr>
            <td>
                ID
            </td>
            <td>
                NOMBRE
            </td>
            <td>
                ORIGEN
            </td>
            <td>
                CODIGO BARRA
            </td>
            <td>
                PRECIO
            </td>
            <td>
                FOTO
            </td>
        </tr>";

foreach($arrayFiltrado as $producto)
{
    echo "
            <tr>
                <td>
                    $producto->id
                </td>
                <td>
                    $producto->nombre
                </td>
                <td>
                    $producto->origen
                </td>
                <td>
                    $producto->codigoBarra
                </td>
                <td>
                    $producto->precio
                </td>
                <td>
                    <img src=$producto->pathFoto alt=foto
                </td>
            </tr>";
}
echo "</table>";