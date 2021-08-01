<?php

// Enviar (por POST) a la página nexo.php:
// *-accion => 'alta'
// *-nombre => 'su nombre'
// *-apellido => 'su apellido'
// *-legajo => 'su legajo'
// Recuperar los valores enviados y agregarlos al archivo ./archivos/alumnos.txt
// El formato que deberá tener cada registro es el siguiente:
// *- legajo - apellido - nombre

    // $arrayPost = $_POST;

    // $archivo = fopen('../archivos/alumnos.txt',"w");
    // if ($archivo > 0) {
    //     foreach ($arrayPost as $value) {
    //         $write = fwrite($archivo,' - '.$value);
    //         if ($write > 0) {
    //             echo 'ok';
    //         }else{
    //             echo 'Error en la escritura del archivo';
    //         }
    //     }
    // }
    // fclose($archivo);
    
// Enviar (por GET) a la página nexo.php:
// *-accion => 'listado'
// Recuperar el valor enviado y mostrar el contenido completo del archivo ./archivos/alumnos.txt
// Cada registro se mostrará:
// *- legajo - apellido - nombre

    // $arrayGet = $_GET;

    // $archivo = fopen('../archivos/alumnos.txt',"a");
    // if ($archivo > 0) {
    //     foreach ($arrayGet as $value) {
    //         $write = fwrite($archivo,' - '.$value);
    //         if ($write > 0) {
    //             echo 'ok';
    //         }else{
    //             echo 'Error en la escritura del archivo';
    //         }
    //     }
    // }
    // fclose($archivo);
    // $read = fopen('../archivos/alumnos.txt',"r");
    // if(!feof($read)){
    //     echo fgets($read);    
    // }
    
    // fclose($read);

//     Enviar (por POST) a la página nexo.php:
// *-accion => 'verificar'
// *-legajo => 'su legajo'
// Recuperar los valores enviados y buscar en el archivo ./archivos/alumnos.txt la existencia de un registro que coincida con el legajo recuperado.
// Si se encuentra, mostrar:
// *- legajo - apellido - nombre
// Si no se encuentra, mostrar el siguiente mensaje:
// 'El alumno con legajo 'xxx' no se encuentra en el listado'
// Siendo 'xxx' el valor del legajo enviado por POST.

    $arrayPost = $_POST;
    
    $archivo = fopen('../archivos/alumnos.txt',"r");
    if ($archivo > 0) {
        while(!feof($archivo)){
            $string = fgets($archivo);
            $array = explode(' - ',$string);
            if ($array[1] == $arrayPost['legajo']) {
                echo $string;
                break;
            }else{
                echo 'El alumno con legajo '.$arrayPost['legajo'].' no se encuentra en el listado';
            }
        }
    }
    fclose($archivo);
    