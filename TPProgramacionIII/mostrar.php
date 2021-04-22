
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="javascript/funciones.js"></script>
    <script src="javascript/ajax.js" ></script>
    <script src="javascript/appAjax.js" ></script>
    <title>HTML5 - Listado de Empleados</title>
</head>
<body>
    <header>   
        <!--<form action="index.php" method="POST" id="FormModificar">
            <input type="hidden" name="txtHidden" id="txtHidden">
        </form>-->
            <table align="center">  
            <tr>
                <th style="text-align: left;" colspan="2"><h2>Listado de Empleados</h2></th>
            </tr>
            <tr>
                <td style="text-align: left;"><h4>Info</h4></td>
            </tr>
            <?php
            include_once('Persona.php');
            include_once('Empleado.php');
            include_once('Fabrica.php');
            if (file_exists("archivos/empleados.txt") && filesize("archivos/empleados.txt") > 0) {
                $archivo = fopen("archivos/empleados.txt","r");
                $objFabrica = new Fabrica('Marvel');
                $arrayEmpleados = $objFabrica->GetEmpleados();
                while(!feof($archivo)) {
                if(feof($archivo)){//depurar
                    break;
                }
                $archivotxt = fgets($archivo);
                $arrayEmpleadosExplode = explode('-',$archivotxt);
                if ($arrayEmpleadosExplode[0] != "") {//ver
                    $objEmpleado = new Empleado($arrayEmpleadosExplode[0],$arrayEmpleadosExplode[1],$arrayEmpleadosExplode[2],$arrayEmpleadosExplode[3],$arrayEmpleadosExplode[4],$arrayEmpleadosExplode[5],$arrayEmpleadosExplode[6],$arrayEmpleadosExplode[7]);
                    array_push($arrayEmpleados,$objEmpleado);

                    $legajo = $objEmpleado->GetLegajo();
                    $pathFoto = $objEmpleado->GetPathFoto();
                    $objetoDni = $objEmpleado->GetDni();
                    echo '<tr>';
                    echo '<td>'.$objEmpleado->ToString().'<td>';
                
                    echo '<td>'."<input type='button' onclick='Main.EliminarEmpleado(".$legajo.")' value='Eliminar'>".'<td>';
                    echo '<td>'."<img src='$pathFoto' alt=' ' width='90px' height='90px'>".'<td>';
                    echo '<td>'."<input type='button' onclick='Main.ModificarEmpleado(".$objetoDni.")' value='Modificar'>".'<td>';
                    echo '</tr>';
                    echo '<br>';
                }
            //echo <a href='eliminar.php?txtLegajo=$legajo
                }
            
            fclose($archivo);
            //include('backend/validarSesion.php');
            }else{
                echo '<td><td>El archivo se encuentra vacio<td><td>';
            }
            
            ?>
            </table>
 
        
    </header>
</body>
</html>

