<?php
    include_once("clases/ProductoEnvasado.php");
//     AgregarProductoSinFoto.php: Se recibe por POST el parámetro producto_json (codigoBarra, nombre, origen y 
// precio), en formato de cadena JSON. Se invocará al método Agregar. 
// Se retornará un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.

    // $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : NULL;
    // $clave = isset($_POST["clave"]) ? $_POST["clave"] : NULL;
    // $correo = isset($_POST["correo"]) ? $_POST["correo"] : NULL;
    // $id_perfil = isset($_POST["id_perfil"]) ? $_POST["id_perfil"] : NULL;
    // $sueldo = isset($_POST["sueldo"]) ? $_POST["sueldo"] : NULL;
    $jsonx = isset($_POST["producto_json"]) ? $_POST["producto_json"] : NULL;
    $json = json_decode($jsonx);
    $stdClass = new stdClass();
    $find = false;
    $arrayProd = ProductoEnvasado::Traer();
    
    foreach ($arrayProd as $Prod) {
        if ($Prod->origen == $json->origen && $Prod->nombre == $json->nombre) {
            $find = true;
            break;
        }
    }
    // if (move_uploaded_file($file["tmp_name"], $destino)){
    // $tipoArchivo = pathinfo("./backend/empleados/fotos/".$file["name"], PATHINFO_EXTENSION);
    // $foto = "./backend/empleados/fotos/".$nombre.'.'.date('His').'.'.$tipoArchivo;
    // $destino = "empleados/fotos/".$nombre.'.'.date('His').'.'.$tipoArchivo;
    if ($find == false) {
            $producto = new ProductoEnvasado($json->nombre,$json->origen,null,$json->codigoBarra,$json->precio,null);
            $retorno =$producto->Agregar() == true ? true : false;
            if ($retorno == true) {
                $stdClass->exito = true;
                $stdClass->mensaje = "Se ha agregado el producto a la base de datos con su foto";
            }else{
                $stdClass->exito = true;
                $stdClass->mensaje = "Ocurrio un error en la consulta";
            }
        }else{
            $stdClass->exito = false;
            $stdClass->mensaje = "El producto ya se encuentra en la base de datos"; 
        }
    
    
    echo json_encode($stdClass);
?>
