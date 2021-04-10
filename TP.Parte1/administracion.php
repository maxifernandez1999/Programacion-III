<?php
    include_once('Persona.php');
    include_once('Empleado.php');
    include_once('Fabrica.php');
    $arrayAsociativo = $_POST;
    $nombre = '';
    $apellido = '';
    $dni = 0;
    $sexo = '';
    $legajo = 0;
    $sueldo = 0;
    $turno = '';
    foreach ($arrayAsociativo as $key => $value) {
        switch ($key) {
            case 'txtNombre':
                $nombre = $value;
            break;
            case 'txtApellido':
                $apellido = $value;
            break;
            case 'txtDni':
                $dni = $value;
            break;
            case 'cboSexo':
                $sexo = $value;
            break;
            case 'txtLegajo':
                $legajo = $value;
            break;
            case 'txtSueldo':
                $sueldo = $value;
            break;
            case 'rdoTurno':
                $turno = $value;
            break;
            default:
                # code...
            break;
        }
        
    }
    $empleado = new Empleado($nombre,$apellido,$dni,$sexo,$legajo,$sueldo,$turno);

    $fabrica = new Fabrica('EASports');
    
    //carga la fabrica con los empleados en el txt
    $fabrica->TraerDeArchivo('archivos/empleados.txt');

    //agrega un empleado al array de empleados
    if($fabrica->AgregarEmpleado($empleado)){
        $fabrica->GuardarEnArchivo('archivos/empleados.txt');
        ?>
            <a href="mostrar.php">Volver a mostrar.php</a>
        <?php
    }else{
        echo 'no se pudo guardar en el archivo de texto<br>';
        ?>
            <a href="index.html">Volver a index.html</a>
        <?php
    }

    // $archivo = fopen("archivos/empleados.txt","a");
    // $valor = fwrite($archivo,$empleado->ToString()."\r\n");
    // if ($valor > 0) {
    // /   
           //<a href="mostrar.php">Volver a Mostrar.php</a>
    //     
    // }else{
    //    
    //     //<a href="index.html">Volver a index.html</a>
         
    // }
    // fclose($archivo);