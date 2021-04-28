<?php
    session_start();
    if(session_destroy()){
        header("Location: http://localhost/Programacion-III/TPProgramacionIII/index.php");
    }else{
        echo 'Error al intentar cerrar la sesion';
    }
    

?>