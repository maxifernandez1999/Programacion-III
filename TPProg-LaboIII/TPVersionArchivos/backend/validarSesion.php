<?php
    session_start();
    if (!(isset($_SESSION['DNIEmpleado']))) {
        header("Location: http://localhost/Programacion-III/TPProg-LaboIII/TPVersionArchivos/index.php");
    }
?>