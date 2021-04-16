<?php
    include_once('Persona.php');
    include_once('Empleado.php');
    include_once('Fabrica.php');
    $valor = ($_GET["txtLegajo"]);
    $retorno = false;
    $archivo = fopen("archivos/empleados.txt","r");
    while(!feof($archivo)) {
        $archivotxt = trim(fgets($archivo));
        $arrayEmpleados = explode('-',$archivotxt);
        if ($arrayEmpleados[0] != 0) {
            $objEmpleado = new Empleado($arrayEmpleados[0],$arrayEmpleados[1],$arrayEmpleados[2],$arrayEmpleados[3],$arrayEmpleados[4],$arrayEmpleados[5],$arrayEmpleados[6],$arrayEmpleados[7]);
            if($objEmpleado->GetLegajo() == $valor){
                $objFabrica = new Fabrica('RiotGames');
                $objFabrica->TraerDeArchivo('archivos/empleados.txt');
                if($objFabrica->EliminarEmpleado($objEmpleado)){
                    $objFabrica->GuardarEnArchivo('archivos/empleados.txt');
                    echo 'Se ha guardado en archivo de texto';
                }else{
                    echo 'no se ha podido eliminar el empleado';
                }
                $retorno = false;
                //break;
                break;
            }else{
                $retorno = true;
            }   
        }
    }
    if ($retorno == true) {
        echo 'No se a encontrado al empleado que desea eliminar'.'<br>';
                ?>
                <a href="mostrar.php">Volver a Mostrar.php</a>
                <a href="index.html">Volver a index.html</a>
                <?php
    }
    fclose($archivo);

    