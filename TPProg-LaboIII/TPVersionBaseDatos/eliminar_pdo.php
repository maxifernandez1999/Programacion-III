<?php
    include_once('Persona.php');
    include_once('Empleado.php');
    include_once('Fabrica.php');
    include_once("DB_PDO.php");
    $legajo = ($_GET["txtLegajo"]);
    $id = ($_GET["id"]);
    $retorno = false;
    $objFabrica = new Fabrica("xd");
    $consultaSelect = $objFabrica->SelectEmpleados();
    $resultado = $consultaSelect->fetchAll();
    foreach ($resultado as $value) {
        if ($value["legajo"] == $legajo) {
            if($value["id"] == $id){
                $consultaDelete = $objFabrica->DeleteEmpleado($id);
                unlink($value["pathfoto"]);
                break;
            }
        }
    }

    echo "eliminado";
    //$archivo = fopen("archivos/empleados.txt","r");
    // while(!feof($archivo)) {
    //     $archivotxt = trim(fgets($archivo));
    //     $arrayEmpleados = explode('-',$archivotxt);
    //     if ($arrayEmpleados[0] != 0) {
    //         $objEmpleado = new Empleado($arrayEmpleados[0],$arrayEmpleados[1],$arrayEmpleados[2],$arrayEmpleados[3],$arrayEmpleados[4],$arrayEmpleados[5],$arrayEmpleados[6],$arrayEmpleados[7]);
    //         if($objEmpleado->GetLegajo() == $valor){
    //             $objFabrica = new Fabrica('RiotGames');
    //             $objFabrica->TraerDeArchivo('archivos/empleados.txt');
    //             if($objFabrica->EliminarEmpleado($objEmpleado)){
    //                 $objFabrica->GuardarEnArchivo('archivos/empleados.txt');
    //                 echo 'Se ha guardado en archivo de texto';
    //             }else{
    //                 echo 'no se ha podido eliminar el empleado';
    //             }
    //             $retorno = false;
    //             //break;
    //             break;
    //         }else{
    //             $retorno = true;
    //         }   
    //     }
    // }
    // if ($retorno == true) {
    //     echo 'No se a encontrado al empleado que desea eliminar'.'<br>';
    //             
    // }
    // fclose($archivo);

    