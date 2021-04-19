<?php
    session_start();
    if (!(isset($_SESSION['DNIEmpleado']))) {
        header("Location: http://localhost/Programacion-III/TP.Parte1/login.html");
    }
?>