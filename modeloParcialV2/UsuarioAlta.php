<?php
    include("clases/Usuario.php");
    $email = isset($_POST["email"]) ? $_POST["email"] : NULL;
    $clave = isset($_POST["clave"]) ? $_POST["clave"] : NULL;
    $producto = new Usuario($email,$clave);
    echo $producto->GuardarEnArchivo();

?>