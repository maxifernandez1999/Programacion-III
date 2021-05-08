<?php
    include_once('Fabrica.php');
    include_once('Empleado.php');
    include_once('Persona.php');
    $valorGET = isset($_GET["txtDni"]) ? $_GET["txtDni"] : NULL;
    $objFabrica = new Fabrica("RiotGames");
    $consultaSelect = $objFabrica->SelectEmpleados();
    //$resultado = $consultaSelect->fetchAll();
    //$consultaSelect->setFetchMode(PDO::FETCH_INTO, new Empleado);
                        
    //foreach ($consultaSelect as $obj) {
        // $empleado = new Empleado($obj->nombre,$obj->apellido,$obj->dni,$obj->sexo,$obj->legajo,$obj->sueldo,$obj->turno,$obj->pathfoto);
        // $objson =  json_encode($empleado);
        // echo $objson;
    //}
    while ($obj = $consultaSelect->fetch(PDO::FETCH_LAZY)) {
        if($obj->dni == $valorGET){
            //$objFabrica->DeleteEmpleado($obj->id);
            $empleado = new Empleado($obj->nombre,$obj->apellido,$obj->dni,$obj->sexo,$obj->legajo,$obj->sueldo,$obj->turno,$obj->pathfoto);
            unlink($obj->pathfoto);
            $objson =  json_encode($empleado);
            $objFabrica->DeleteEmpleado($obj->id);
            echo $objson;
            //$arrayEmpleados = array('nombre'=>$obj->nombre,'apellido'=>$obj->apellido,'dni'=>$obj->dni,'sexo'=>$obj->sexo,'legajo'=>$obj->legajo,'sueldo'=>$obj->sueldo,'turno'=>$obj->turno,'pathfoto'=>$obj->pathfoto);
            
            // $objson =  json_encode($arrayEmpleados);
            // echo $objson;
            break;
        }
    }
                
    // foreach ($resultado as $value) {
    //     if ($value["dni"] == $valorGET) {
    //         $objFabrica->UpdateEmpleado()
    //     }
    // }
    // if (isset($valorGET)) {
    //     $objFabrica = new Fabrica('RiotGames');
    //     $objFabrica->TraerDeArchivo('archivos/empleados.txt');
    //     foreach ($objFabrica->GetEmpleados() as $objEmpleado) {
    //         if ($objEmpleado->GetDni() == $valorGET) {
    //             if($objFabrica->EliminarEmpleado($objEmpleado)){
    //                 $objFabrica->GuardarEnArchivo('archivos/empleados.txt');
    //                 echo $objEmpleado->ToString();
    //             }else{
    //                 echo 'no se ha podido eliminar el empleado';
    //             }
    //             break;
    //         }
    //     }
        
    // }

?>