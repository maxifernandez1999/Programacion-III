<?php
    include_once("clases/ICRUD.php");
    include_once("clases/Empleado.php");
    $id = isset($_POST["id"]) ? $_POST["id"] : NULL;
    $accion = isset($_POST["accion"]) ? $_POST["accion"]: NULL;
    $arrayEmpleados = Empleado::TraerTodos();
    $existe = false;
    foreach ($arrayEmpleados as $empleado) {
        if($empleado->id == $id){
            $existe = true;
            break;
        }
    }
    
    if($id!=null && $accion == "borrar"){
        if($existe == true){
            $exito = Empleado::Eliminar($id) == true ? true : false;
            if ($exito == true) {
                
                echo "{\"exito\":true,\"mensaje\":\"Se ha eliminado el empleado\"}";
            }else{
                echo "Ha ocurrido un error con la consulta";
            }
        }else{
            echo "{\"exito\":false,\"mensaje\":\"No se ha podido eliminar el empleado\"}";
        }

    }  

?>