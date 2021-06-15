<?php
    include_once("clases/Usuario.php");
    $email = isset($_POST["email"]) ? $_POST["email"] : NULL;
    $clave = isset($_POST["clave"]) ? $_POST["clave"] : NULL;
    $user = new Usuario($email,$clave);
    if(Usuario::VerificarExistencia($user)){
        setcookie($email,date('His'));
        header("Location: ListadoUsuarios.php");
    }else{
        echo "no se ha encontrado el usuario";
    }
    
?>