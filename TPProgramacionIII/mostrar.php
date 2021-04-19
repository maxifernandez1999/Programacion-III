<?php
    include_once('Persona.php');
    include_once('Empleado.php');
    include_once('Fabrica.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="javascript/funciones.js"></script>
    <title>HTML5 - Listado de Empleados</title>
</head>
<body>
    <header>
        <h2>Listado de Empleados</h2>
        <table align="center">
        <form action="index.php" method="POST" id="FormModificar">
            <input type="hidden" name="txtHidden" id="txtHidden">
        </form>
            <section style="text-align:center;"><h4>Info</h4></section>
            <?php
            $archivo = fopen("archivos/empleados.txt","r");
            echo '<hr>';
            $objFabrica = new Fabrica('Marvel');
            $arrayEmpleados = $objFabrica->GetEmpleados();
            while(!feof($archivo)) {
            if(feof($archivo)){//depurar
                break;
            }
            $archivotxt = fgets($archivo);
            $arrayEmpleadosExplode = explode('-',$archivotxt);
            if ($arrayEmpleadosExplode[0] != null) {//ver
                $objEmpleado = new Empleado($arrayEmpleadosExplode[0],$arrayEmpleadosExplode[1],$arrayEmpleadosExplode[2],$arrayEmpleadosExplode[3],$arrayEmpleadosExplode[4],$arrayEmpleadosExplode[5],$arrayEmpleadosExplode[6],$arrayEmpleadosExplode[7]);
                array_push($arrayEmpleados,$objEmpleado);

                $legajo = $objEmpleado->GetLegajo();
                $pathFoto = $objEmpleado->GetPathFoto();
                $objetoDni = $objEmpleado->GetDni();
                echo '<tr>';
                echo '<td>'.$objEmpleado->ToString().'<td>';
                echo '<td>'."<a href='eliminar.php?txtLegajo=$legajo'>Eliminar</a>".'<td>';
                echo '<td>'."<img src='$pathFoto' alt=' ' width='90px' height='90px'>".'<td>';
                echo '<td>'."<input type='button' onclick='AdministrarModificar(".$objetoDni.")' value='Modificar'>".'<td>';
                echo '</tr>';
            }
            
                }
            
            fclose($archivo);
            echo "<br><a href='backend/cerrarSesion.php'>desloguearse</a>"
            ?>
            
        </table>
        <hr>
        <a href="index.html">Volver a index.html</a>
        
        <?php
        //include('backend/validarSesion.php');
        ?>
    </header>
</body>
</html>

