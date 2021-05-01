<?php
    // ModificarEmpleado.php: Se recibirán por POST los siguientes valores: empleado_json (id, nombre, correo, 
    // clave, id_perfil, sueldo y pathFoto, en formato de cadena JSON) y foto (para modificar un empleado en la base 
    // de datos. Invocar al método Modificar. 
    // Nota: El valor del id, será el id del empleado 'original', mientras que el resto de los valores serán los del 
    // empleado modificado.
    // Se retornará un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.
    include_once("clases/Empleado.php");
    $json = isset($_POST["empleado_json"]) ? $_POST["empleado_json"] : NULL;
    $file = $_FILES["foto"];

    $jsonDecode = json_decode($json);
    $arrayEmpleados = Empleado::TraerTodos();
    $existe = false;
    foreach ($arrayEmpleados as $empleado) {
        if($empleado->id == $jsonDecode->id){
            $existe = true;
            $obj = new Empleado($jsonDecode->id,$jsonDecode->nombre,$jsonDecode->correo,$jsonDecode->clave,$jsonDecode->id_perfil,null,$jsonDecode->foto,$jsonDecode->sueldo);
            break;
        }
    }
    if ($existe == true) {  
        $exito = $obj->Modificar() == true ? true : false;
        if ($exito == true) {
            echo "{\"exito\":true,\"mensaje\":\"Se ha modificado el empleado\"}";
        }else{
            echo "Error en la ejecucion de la consulta";
        }
    }else{
        echo "{\"exito\":false,\"mensaje\":\"No se ha podido modificar el empleado\"}";
    }
?>