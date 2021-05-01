<?php
    session_start();
    include("../DB_PDO.php");
    if (isset($_POST['txtDni']) && isset($_POST['txtApellido'])){
        $dni = $_POST['txtDni'];
        $apellido = $_POST['txtApellido'];

        $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","tpproglaboiii");
        $consulta = $objPDO->RetornarConsulta("SELECT * FROM empleados");
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        foreach ($resultado as $value) {
            if($value["dni"] == $dni && $value["apellido"] == $apellido){
                $_SESSION['DNIEmpleado'] = $dni;
                $retorno = true;
                header("Location: http://localhost/Programacion-III/TPProg-LaboIII/TPVersionBaseDatos/principal.php");          
                break;
            }else{
                $retorno= false;
            }
        }
        if ($retorno == false) {
            ?>
                <h1 style="font-size: 25px;color:black;">No existe el empleado en el archivo de texto!</h1><hr>
                <a style="font-size:large;color:black;font-weight:500;text-decoration:none;" href="../index.php">Volver a LOGIN</a>
            <?php
        }




    }







    
    // session_start();
    // if (isset($_POST['txtDni']) && isset($_POST['txtApellido'])){
    //     $dni = $_POST['txtDni'];
    //     $apellido = $_POST['txtApellido'];
    //     $nombreArchivo = '../archivos/empleados.txt';
    //     $retorno = true;
    //     if (file_exists($nombreArchivo)) {
    //         if (!empty($nombreArchivo)) {
    //             $open = fopen($nombreArchivo,'r');
    //             while(!feof($open)) {
    //                 while (feof($open)) {
    //                     break;
    //                 }
    //                 $archivotxt = trim(fgets($open));
    //                 $arrayEmpleados = explode('-',$archivotxt);
    //                 if ($arrayEmpleados[0] != null) {
    //                     if ($arrayEmpleados[1] == $apellido && $arrayEmpleados[2] == $dni) {
    //                         $_SESSION['DNIEmpleado'] = $dni;
    //                         $retorno = true;
    //                         header("Location: http://localhost/Programacion-III/TPProgramacionIII/principal.php");
                            
    //                         break;
    //                     }else{
    //                         $retorno= false;
    //                     }
    //                 }
    //                 }
    //                 if ($retorno == false) {
    //                     a>
    //                     <?php
    //                 }
    //             }
    //             fclose($open);
    //         }
    // }
?>