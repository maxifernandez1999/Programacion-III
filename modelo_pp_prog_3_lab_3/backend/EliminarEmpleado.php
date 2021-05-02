<?php
    include_once("clases/ICRUD.php");
    include_once("clases/Empleado.php");
    $id = isset($_POST["id"]) ? $_POST["id"] : NULL;
    $arrayEmpleados = Empleado::TraerTodos();
    $stdClass = new stdClass();
    $existe = false;
    foreach ($arrayEmpleados as $empleado) {
        if($empleado->id == $id){
            $existe = true;
            break;
        }
    }
    if($existe == true){
        $exito = Empleado::Eliminar($id) == true ? true : false;
        if ($exito == true) {
            $stdClass->exito = true;
            $stdClass->mensaje = "Se ha eliminado el empleado";
        }else{
            $stdClass->exito = false;
            $stdClass->mensaje = "Error en la ejecucion de la consulta";
        }
    }else{
        $stdClass->exito = false;
        $stdClass->mensaje = "No se ha encontrado el usuario a eliminar en la BD";
    }
    echo json_encode($stdClass);

?>