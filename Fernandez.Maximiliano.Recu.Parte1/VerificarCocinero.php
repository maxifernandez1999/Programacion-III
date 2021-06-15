<?php
    include_once("clases/Cocinero.php");
    $email = isset($_POST["email"]) ? $_POST["email"] : NULL;
    $clave = isset($_POST["clave"]) ? $_POST["clave"] : NULL;
    
    $cocinero = Cocinero::TraerTodos("./archivos/cocinero.json");
    foreach ($cocinero as $value) {
        if ($value->email == $email) {
            $especialidad = $value->especialidad;
            break;
        }
        
    }
    $obj = Cocinero::VerificarExistencia($email,$clave);
    $objjson = json_decode($obj);
    if ($objjson->exito == true) {
        setcookie($email."_".$especialidad,date('His'));
        $objjson->mensaje;
    }else{
        $objjson->exito;
        $objjson->mensaje;
    }
    
    echo json_encode($objjson);
?>