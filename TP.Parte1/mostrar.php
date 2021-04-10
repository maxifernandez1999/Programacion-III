<?php
    include_once('Persona.php');
    include_once('Empleado.php');
    
    $archivo = fopen("archivos/empleados.txt","r");
    while(!feof($archivo)) {
        if(feof($archivo)){
            break;
        }
        $archivotxt = fgets($archivo);
        $arrayEmpleados = explode('-',$archivotxt);
        if ($arrayEmpleados[0] != null) {
            $objEmpleado = new Empleado($arrayEmpleados[0],$arrayEmpleados[1],$arrayEmpleados[2],$arrayEmpleados[3],$arrayEmpleados[4],$arrayEmpleados[5],$arrayEmpleados[6]);
            $legajo = $objEmpleado->GetLegajo();
            echo $objEmpleado->ToString();
            echo "<a href='eliminar.php?txtLegajo=$legajo'>Eliminar</a>";
            echo '<br>';
            
        }
    }
    fclose($archivo);
    ?>
        <a href="index.html">Volver a index.html</a>
    <?php

    ?>
