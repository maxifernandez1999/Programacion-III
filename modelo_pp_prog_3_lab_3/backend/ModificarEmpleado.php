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
    $stdClass = new stdClass();
    $arrayEmpleados = Empleado::TraerTodos();
    $changeFoto = true;
    $existe = false;
    foreach ($arrayEmpleados as $empleado) {
        if($empleado->id == $jsonDecode->id){
            $existe = true;
            if(file_exists("empleados/fotos/".$empleado->foto)){
                if ($empleado->foto == "./backend/empleados/fotos/".$jsonDecode->foto) {
                    $changeFoto = false;
                }else{
                    $changeFoto = true;
                    unlink($empleado->foto);
                }
            }
            break;
        }
    }
    $tipoArchivo = pathinfo("./backend/empleados/fotos/".$file["name"], PATHINFO_EXTENSION);
    $foto = "./backend/empleados/fotos/".$jsonDecode->nombre.'.'.date('His').'.'.$tipoArchivo;
    $destino = "empleados/fotos/".$jsonDecode->nombre.'.'.date('His').'.'.$tipoArchivo;
    
    
    if ($existe == true) {
        if ($changeFoto == true) { 
            if(move_uploaded_file($file["tmp_name"], $destino)){
                $obj = new Empleado($jsonDecode->id,$jsonDecode->nombre,$jsonDecode->correo,$jsonDecode->clave,$jsonDecode->id_perfil,null,$foto,$jsonDecode->sueldo);
                $exito = $obj->Modificar() == true ? true : false;
                if ($exito == true) {
                    $stdClass->exito = true;
                    $stdClass->mensaje = "Se ha modificado el empleado de la BD";
                }else{
                    $stdClass->exito = false;
                    $stdClass->mensaje = "Error en la ejecucion de la consulta";
                }
            }else{
                $stdClass->exito = false;
                $stdClass->mensaje = "No se pudo guardar el archivo";
            }
        }else{
            $obj = new Empleado($jsonDecode->id,$jsonDecode->nombre,$jsonDecode->correo,$jsonDecode->clave,$jsonDecode->id_perfil,null,$jsonDecode->foto,$jsonDecode->sueldo);
            $exito = $obj->Modificar() == true ? true : false;
            if ($exito == true) {
                $stdClass->exito = true;
                $stdClass->mensaje = "Se ha modificado el empleado de la BD";
            }else{
                $stdClass->exito = false;
                $stdClass->mensaje = "Error en la ejecucion de la consulta";
            }
        }
    }else{
        $stdClass->exito = false;
        $stdClass->mensaje = "El empleado que desea modificar no se encuentra en la base de datos";
    }    

    echo json_encode($stdClass);
        
        
    
?>