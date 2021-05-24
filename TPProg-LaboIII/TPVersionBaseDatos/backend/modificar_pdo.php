<?php
    include_once('Fabrica.php');
    include_once('Empleado.php');
    include_once('Persona.php');
    $valorGET = isset($_GET["txtDni"]) ? $_GET["txtDni"] : NULL;
    $objFabrica = new Fabrica("RiotGames");
    $consultaSelect = $objFabrica->SelectEmpleados();
    while ($obj = $consultaSelect->fetch(PDO::FETCH_LAZY)) {
        if($obj->dni == $valorGET){
            $empleado = new Empleado($obj->nombre,$obj->apellido,$obj->dni,$obj->sexo,$obj->legajo,$obj->sueldo,$obj->turno,$obj->pathfoto);
            unlink($obj->pathfoto);
            $objson =  json_encode($empleado);
            $objFabrica->DeleteEmpleado($obj->id);
            echo $objson;
            break;
        }
    }

?>