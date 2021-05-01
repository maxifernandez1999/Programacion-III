<?php
    include_once("clases/Empleado.php");
    $arrayEmpleados = Empleado::TraerTodos();
    $tabla = isset($_GET["tabla"]) ? $_GET["tabla"] : NULL;
    if (($tabla != NULL) & ($tabla == "mostrar")) {
        echo"<table align=center>
                <tr>
                    <th>ID</th>
                    <th>CORREO</th>
                    <th>NOMBRE</th>
                    <th>ID_PERFIL</th>
                    <th>DESCRIPCION</th>
                    <th>SUELDO</th>
                    <th>FOTO</th>
                </tr>";
            foreach ($arrayEmpleados as $empleado) {
                echo"<tr>
                        <td>$empleado->id</td>
                        <td>$empleado->correo</td>
                        <td>$empleado->nombre</td>
                        <td>$empleado->id_perfil</td>
                        <td>$empleado->perfil</td>
                        <td>$empleado->sueldo</td>
                        <td><img src='$empleado->foto' width='50px' height='50px'></td>
                    </tr>";
                    
            } 
        echo "</table>";  
    }else{
        echo json_encode($arrayEmpleados);
        
    }
?>