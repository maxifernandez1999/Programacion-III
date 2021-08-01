<?php
    include("clases/ProductoEnvasado.php");
    $codigoBarra = isset($_POST["codigoBarra"]) ? $_POST["codigoBarra"] : NULL;
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : NULL;
    $origen = isset($_POST["origen"]) ? $_POST["origen"] : NULL;
    $precio = isset($_POST["precio"]) ? $_POST["precio"] : NULL;
    $file = $_FILES["foto"];
    $stdClass = new stdClass();
    $tipoArchivo = pathinfo("productos/imagenes/".$file["name"], PATHINFO_EXTENSION);
    $destino = "productos/imagenes/".$nombre.'.'.$origen.'.'.date('His').'.'.$tipoArchivo;
    $fotoName = $nombre.'.'.$origen.'.'.date('His').'.'.$tipoArchivo;
    $producto = new ProductoEnvasado($nombre,$origen,null,$codigoBarra,$precio,$fotoName);
    
    $array = ProductoEnvasado::Traer();
    if($producto->Existe($array)){
        $stdClass->exito = false;
        $stdClass->mensaje = "Ya se encuentra el producto en la base de datos";
    }else{
        $producto->Agregar();
        //$foto = "./backend/empleados/fotos/".$nombre.'.'.date('His').'.'.$tipoArchivo;
        if (move_uploaded_file($file["tmp_name"], $destino)){
            $stdClass->exito = true;
            $stdClass->mensaje = "Se guardo la imagen y el producto en la base de datos";
        }
    }
    echo json_encode($stdClass);
        
            
            
            

    
?>