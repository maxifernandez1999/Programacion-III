<?php
    session_start();
    if (!(isset($_SESSION['DNIEmpleado']))) {
        header("Location: http://localhost/Programacion-III/TPProgramacionIII/index.php");
    }
?>