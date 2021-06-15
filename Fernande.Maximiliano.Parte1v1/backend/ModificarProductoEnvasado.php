<?php
    // ModificarProductoEnvadado.php: Se recibirán por POST los siguientes valores: producto_json (id, codigoBarra, 
    // nombre, origen y precio, en formato de cadena JSON) para modificar un producto envasado en la base de datos. 
    // Invocar al método Modificar. 
    // Nota: El valor del id, será el id del producto envasado 'original', mientras que el resto de los valores serán los del 
    // producto envasado a ser modificado.
    // Se retornará un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.
    include_once("clases/ProductoEnvasado.php");
    include_once("clases/IParte1.php");
    include_once("clases/IParte2.php");
    $json = isset($_POST["producto_json"]) ? $_POST["producto_json"] : NULL;
    $jsonDecode = json_decode($json);
    $stdClass = new stdClass();
    $array = ProductoEnvasado::Traer();
    $existe = false;
    //compruebo si el producto a modificar existe
    foreach ($array as $obj) {
        if($obj->id == $jsonDecode->id){
            $existe = true;
            break;
        }
    }
    
    if ($existe == true) {
         
            $obj = new ProductoEnvasado($jsonDecode->nombre,$jsonDecode->origen,$jsonDecode->id,$jsonDecode->codigoBarra,$jsonDecode->precio,null);
            $exito = $obj->Modificar() == true ? true : false;
            if ($exito == true) {
                $stdClass->exito = true;
                $stdClass->mensaje = "Se ha modificado el producto de la BD";
            }else{
                $stdClass->exito = false;
                $stdClass->mensaje = "Error en la ejecucion de la consulta";
            }
    }else{
        $stdClass->exito = false;
        $stdClass->mensaje = "El producto que desea modificar no se encuentra en la base de datos";
    }    

    echo json_encode($stdClass);
        
        
    
?>