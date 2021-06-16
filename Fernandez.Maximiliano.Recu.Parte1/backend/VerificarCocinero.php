<?php
    include_once("clases/Cocinero.php");
    $email = htmlspecialchars(isset($_POST["email"]) ? $_POST["email"] : NULL);
    $clave = htmlspecialchars(isset($_POST["clave"]) ? $_POST["clave"] : NULL);
    $emailSinPunto = str_replace(".", "_" ,$email);
    $cocinero = Cocinero::TraerTodos("./archivos/cocinero.json");
    foreach ($cocinero as $value) {
        if ($value->email == $email && $value->clave == $clave) {
            $especialidad = trim($value->especialidad);
            break;
        }
        
    }
    $obj = Cocinero::VerificarExistencia($email,$clave);
    $objjson = json_decode($obj);
    if ($objjson->exito == true) {
        setcookie($emailSinPunto."_".$especialidad,date('His'));
        $objjson->mensaje;
    }else{
        $objjson->exito;
        $objjson->mensaje;
    }
    
    echo json_encode($objjson);
?>