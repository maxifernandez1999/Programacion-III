<?php
    include("archivo.php");
    $array = array(1,2,3,4,5);
    Archivos::WriteFile("archivos.txt","w","",$array);
    Archivos::FileRead("archivos.txt");

?>