<?php
    include("Archivos.php");
    include("DataBase.php");
    $db = new DataBase("localhost","root","","testparcial");
    $db->Connection();
    //$ResponseSQLInsert = $db->Query("INSERT INTO nombres (nombre, apellido, dni) VALUES('Elmaxi', 'Fernandez', 4203574)");
    //INSERT INTO `nombres`(`nombre`, `apellido`, `dni`) VALUES ([value-1],[value-2],[value-3])
    $ResponseSQLUpdate = $db->Query("UPDATE nombres SET nombre='ElPablo', apellido='otro_nombre', dni=42125236 WHERE nombre = 'Elmaxi'");
    $ResponseSQL = $db->Query("SELECT * FROM nombres");
    //echo $ResponseSQLInsert;
    echo $ResponseSQLUpdate;
    echo '<br>';
    var_dump($ResponseSQL);
    $db->CloseDB();
    
    // $array = array(1,2,3,4,5);
    // Archivos::WriteFile("archivos.txt","w","",$array);
    // Archivos::FileRead("archivos.txt");
    //Archivos::UploadImage("","file",1000000);
    //Archivos::UploadMultipleImages("","file",1000000);
    //Archivos::DeleteFile("archivos.txt");
    //Archivos::CopyFile("archivo.txt","archivo2.txt");//mismo directorio
    


?>
