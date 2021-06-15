<?php
    include("clases/ProductoEnvasado.php");
    $jsonx = isset($_GET["producto_json"]) ? $_GET["producto_json"] : NULL;
    $json = json_decode($jsonx);

    $array = ProductoEnvasado::Traer();
    $stdClass = new stdClass();
    $existe = false;
    $objjson = null;

    if ($jsonx != null) {
        foreach ($array as $obj) {
            if($obj->id == $json->id){
                $existe = true;
                $ubicacion = $obj->pathFoto;
                break;
            }
        }
        $tipoArchivo = pathinfo("productos/imagenes".$ubicacion, PATHINFO_EXTENSION);
        $ubicacionOriginal = "productos/imagenes/".$ubicacion;
        $nuevaubicacion = "productosBorrados/".$obj->id.'.'.$obj->nombre.'.borrado.'.date('His').'.'.$tipoArchivo;
        $fotoName = $obj->id.'.'.$obj->nombre.'.borrado.'.date('His').'.'.$tipoArchivo;
        if($existe == true){
            if(ProductoEnvasado::Eliminar($json->id)){
                $producto = new ProductoEnvasado($obj->nombre,$obj->origen,$obj->id,$obj->codigoBarra,$obj->precio,$nuevaubicacion);//nueva ubicacion
                $producto->GuardarEnArchivo();
                copy($ubicacionOriginal,$nuevaubicacion);
                unlink($ubicacionOriginal);
                $stdClass->exito = true;
                $stdClass->mensaje = "Producto Eliminado";
            }else{
                $stdClass->exito = false;
                $stdClass->mensaje = "No se ha podido eliminar el producto";
            }
        }else{
            $stdClass->exito = false;
            $stdClass->mensaje = "El producto a eliminar no se encuentra en la base de datos";
        }
        echo json_encode($stdClass);
    }else{
        echo "<table>
            <tr>
                <td>
                    NOMBRE
                </td>
                <td>
                    ORIGEN
                </td>
                <td>
                    ID
                </td>
                <td>
                    CODIGO
                </td>
                <td>
                    PRECIO
                </td>
                <td>
                    FOTO
                </td>
            </tr>";

    $archivo = fopen("archivos/productos_envasados_borrados.txt", "r");

    do 
    {
        $cadena = fgets($archivo);
        $cadena = is_string($cadena) ? trim($cadena) : false;
        if ($cadena != false) 
        {
            $prod = explode("-", $cadena);
            if ($prod[0] != "" && $prod[0] != "\r\n") 
            {
                $producto = new ProductoEnvasado($prod[0], $prod[1], $prod[2], $prod[3], $prod[4], $prod[5]);
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
                                        <img src='{$producto->pathFoto}' width='50px' height='50px'>
                                    </td>
                                </tr>";
            }
        }
    } while (!feof($archivo));
    echo '</table>';
    fclose($archivo);
    }
    
    



?>