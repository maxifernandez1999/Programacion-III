<?php
    $email = isset($_GET["email"]) ? $_GET["email"] : NULL;
    if (isset($_COOKIE[$nombre."_".$origen])) {
        
        echo $_COOKIE[$nombre."_".$origen];
    }else{
        echo "No se ha encontrado la COOKIE";
    }


?>