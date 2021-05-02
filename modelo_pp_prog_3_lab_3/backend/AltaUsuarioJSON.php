<?php
    include("clases/Usuario.php");
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : NULL;
    $clave = isset($_POST["clave"]) ? $_POST["clave"] : NULL;
    $correo = isset($_POST["correo"]) ? $_POST["correo"] : NULL;
    $usuario = new Usuario(null,$nombre,$correo,$clave,null,null);
    echo $usuario->GuardarEnArchivo();


?>