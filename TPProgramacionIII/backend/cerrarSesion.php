<?php
    session_start();
    if(session_destroy()){
        header("Location: http://localhost/Programacion-III/TP.Parte1/login.html");
    }else{
        echo 'Error al intentar cerrar la sesion';
    }
    

?>