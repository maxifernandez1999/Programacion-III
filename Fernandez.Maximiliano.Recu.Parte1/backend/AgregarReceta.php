<?php
    include("clases/Receta.php");
//     AgregarReceta.php: Se recibirán por POST todos los valores: nombre, ingredientes, tipo y foto para registrar una 
// receta en la base de datos. 
// Verificar la previa existencia de la receta invocando al método Existe. Se le pasará como parámetro el array que 
// retorna el método Traer.
// Si la receta ya existe en la base de datos, se retornará un mensaje que indique lo acontecido.
// Si la receta no existe, se invocará al método Agregar. La imagen guardarla en “./recetas/imagenes/”, con el 
// nombre formado por el nombre punto tipo punto hora, minutos y segundos del alta (Ejemplo: 
// chocotorta.pasteleria.105905.jpg). 
// Se retornará un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido
    $ingredientes = isset($_POST["ingredientes"]) ? $_POST["ingredientes"] : NULL;
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : NULL;
    $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : NULL;
    //$foto = isset($_POST["foto"]) ? $_POST["foto"] : NULL;
    $file = $_FILES["foto"];
    $stdClass = new stdClass();


    $tipoArchivo = pathinfo("./recetas/imagenes/".$file["name"], PATHINFO_EXTENSION);
    $destino = "./recetas/imagenes/".$nombre.'.'.$tipo.'.'.date('His').'.'.$tipoArchivo;
    $fotoName = $nombre.'.'.$tipo.'.'.date('His').'.'.$tipoArchivo;
    $receta = new Receta(null,$nombre,$ingredientes,$tipo,$fotoName);
    
    $array = Receta::Traer();
    if($receta->Existe($array)){
        $stdClass->exito = false;
        $stdClass->mensaje = "Ya se encuentra el producto en la base de datos";
    }else{
        $receta->Agregar();
        //$foto = "./backend/empleados/fotos/".$nombre.'.'.date('His').'.'.$tipoArchivo;
        if (move_uploaded_file($file["tmp_name"], $destino)){
            $stdClass->exito = true;
            $stdClass->mensaje = "Se guardo la imagen y el producto en la base de datos";
        }
    }
    echo json_encode($stdClass);
        
            
            
            

    
?>