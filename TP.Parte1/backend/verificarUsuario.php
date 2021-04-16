<?php
    session_start();
    if (isset($_POST['txtDni']) && isset($_POST['txtApellido'])){
        $dni = $_POST['txtDni'];
        $apellido = $_POST['txtApellido'];
        $nombreArchivo = '../archivos/empleados.txt';
        $retorno = true;
        if (file_exists($nombreArchivo)) {
            if (!empty($nombreArchivo)) {
                $open = fopen($nombreArchivo,'r');
                while(!feof($open)) {
                    while (feof($open)) {
                        break;
                    }
                    $archivotxt = trim(fgets($open));
                    $arrayEmpleados = explode('-',$archivotxt);
                    if ($arrayEmpleados[0] != null) {
                        if ($arrayEmpleados[1] == $apellido && $arrayEmpleados[2] == $dni) {
                            $_SESSION['DNIEmpleado'] = $dni;
                            $retorno = true;
                            header("Location: http://localhost/Programacion-III/TP.Parte1/mostrar.php");
                            
                            break;
                        }else{
                            $retorno= false;
                        }
                    }
                    }
                    if ($retorno == false) {
                        echo 'No existe el empleado en el archivo de texto<br>';
                        ?>
                            <a href="../login.html">Volver a login.php</a>
                        <?php
                    }
                }
                fclose($open);
            }
    }
?>