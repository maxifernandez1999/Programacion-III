<?php

// PARTE 1:
// Enviar (por POST) a la página nexo.php:
// *-accion => 'alta'
// *-nombre => 'su nombre'
// *-apellido => 'su apellido'
// *-legajo => 'su legajo'
// *-foto => 'imagen .png/jpg/etc'


// Recuperar los valores enviados y agregarlos al archivo ./archivos/alumnos.txt
// El formato que deberá tener cada registro es el siguiente:
// *- legajo - apellido - nombre - foto (el path)

    // $arrayValores = $_POST;
   
    // $imagePath = $_FILES['foto']['tmp_name'];
    
    // $valor = fopen('../archivos/alumnos.txt','a');
    // if ($valor > 0 && filesize($valor) == 0){
    //     foreach ($arrayValores as $value) {
    //         fwrite($valor,' - '.$value);
    //     }
    //     fwrite($valor,' - '.$imagePath);
    // }
    // fclose($valor);

// La foto guardarla en ./fotos y su nombre:
// *- legajo.extension
    // $destino = 'fotos/'.$_POST['legajo'].'.'.pathinfo($_FILES['foto']['name'],PATHINFO_EXTENSION);
    // if (!file_exists($destino)) {
    //     if (move_uploaded_file($imagePath,$destino)) {
    //         echo 'Se guardo el archivo';
    //     }else{
    //         echo 'Lamentablemente ocurrio un error';
    //     }
    // }else{
    //     echo 'El archivo ya existe';
    // }
    
// PARTE 2:
// Enviar (por GET) a la página nexo.php:
// *-accion => 'listado'
// Recuperar el valor enviado y mostrar el contenido completo del archivo ./archivos/alumnos.txt
// Cada registro se mostrará:
// *- legajo - apellido - nombre - foto

    // $valorGET = $_GET['accion'];

    // $open = fopen('../archivos/alumnos.txt','r');
    // if ($open > 0) {
    //     if (!feof($open)) {
    //         echo fgets($open);
    //     }
    // }
    // fclose($open);

// PARTE 3:
// Enviar (por POST) a la página nexo.php:
// *-accion => 'verificar'
// *-legajo => 'su legajo'
// Recuperar los valores enviados y buscar en el archivo ./archivos/alumnos.txt la existencia de un registro que coincida con el legajo recuperado.
// Si se encuentra:
// redirigir hacia la página 'principal.php'
// *- legajo - apellido - nombre - foto
// Si no se encuentra, mostrar el siguiente mensaje:
// 'El alumno con legajo 'xxx' no se encuentra en el listado'
// Siendo 'xxx' el valor del legajo enviado por POST.
    session_start();
    $arrayValoresPOST = $_POST;
    $valorLegajo = '';
    foreach ($arrayValoresPOST as $key => $value) {
        if ($key == 'legajo') {
            $valorLegajo = $value;
            break;
        }    
    }    
    $open = fopen('../archivos/alumnos.txt','r');
    if ($open > 0) {
        if (!feof($open)) {
            $string = fgets($open);
            $arrayString = explode(' - ',$string);
            foreach ($arrayString as $value) {
                if(is_numeric($value)){
                    if ($valorLegajo == $value) {
                        $_SESSION['datos'] = $arrayString[2];
                        $_SESSION['datos'] = $arrayString[3];
                        $_SESSION['datos'] = $value;
                        ?>
                            <a href="principal.php">Volver a principal.php</a>
                        <?php
                    }else{
                        echo 'El alumno con legajo '.$valorLegajo.' no se
                        encuentra en el listado';
                    }  
                }
            }
        }
    }
     fclose($open);
//     Agregar funcionalidad en nexo.php
// Si se encuentra el legajo, crear variables de sesión que guarden el legajo, el nombre y apellido del alumno.
// Luego, redirigir hacia principal.php
