<?php
    include_once('Fabrica.php');
    include_once('Empleado.php');
    include_once('Persona.php');
    $valorGET = $_GET['txtDni'];
    if (isset($valorGET)) {
        $objFabrica = new Fabrica('RiotGames');
        $objFabrica->TraerDeArchivo('archivos/empleados.txt');
        foreach ($objFabrica->GetEmpleados() as $objEmpleado) {
            if ($objEmpleado->GetDni() == $valorGET) {
                
                if($objFabrica->EliminarEmpleado($objEmpleado)){
                    $objFabrica->GuardarEnArchivo('archivos/empleados.txt');
                    echo $objEmpleado->ToString();
                }else{
                    //echo 'no se ha podido eliminar el empleado';
                }
                break;
            }
        }
        
    }

?>