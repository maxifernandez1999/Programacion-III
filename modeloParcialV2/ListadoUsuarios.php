<?php
include_once("clases/Usuario.php");
    $usuarios = Usuario::TraerTodos();
    foreach ($usuarios as $user) {
        echo $user->toString()."<br>";
    }
?>