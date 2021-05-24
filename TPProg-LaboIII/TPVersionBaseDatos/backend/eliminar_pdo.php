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