
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
    <h2 style="text-align: center;">Listado de Empleados</h2>
        <table align="center">  
            <tbody>
                <thead>
                    <tr>
                        <th><h4 style="text-align: left;">Info</h4></th>
                    </tr>
                    <hr>
                    <?php
                    include_once('Persona.php');
                    include_once('Empleado.php');
                    include_once('Fabrica.php');
                    $objFabrica = new Fabrica("xd");
                    $consulta = $objFabrica->SelectEmpleados();
                    //$resultado = $consulta->fetchAll();//probar con fetch
                    // while ($value = $consulta->fetchObject("Empleado")) {
                    //     $obj->Html .= "**". $fila->MostrarDatos(). '**';
                    // }
                    while($value = $consulta->fetch()){
                        $objEmpleado = new Empleado($value["nombre"],$value["apellido"],$value["dni"],$value["sexo"],$value["legajo"],$value["sueldo"],$value["turno"],$value["pathfoto"]);  
                        $legajo = $objEmpleado->GetLegajo();
                        $pathFoto = $objEmpleado->GetPathFoto();
                        $objetoDni = $objEmpleado->GetDni();
                        $arrayEmpleados = $objFabrica->GetEmpleados();
                        array_push($arrayEmpleados,$objEmpleado);
                        echo '<tr>';
                                echo '<td style="font-weight: 300;font-size:18px;">'.$objEmpleado->ToString().'<td>';
                
                                echo '<td>'."<input type='button' onclick='Main.EliminarEmpleado(".$legajo.','.$value["id"].")' value='Eliminar'>".'<td>';
                                echo '<td>'."<img src='$pathFoto' alt=' ' width='90px' height='90px'>".'<td>';
                                echo '<td>'."<input type='button' onclick='Main.ModificarEmpleado(".$objetoDni.")' value='Modificar'>".'<td>';
                                echo '</tr>';
                                echo '<br>';
                                if (count($arrayEmpleados) == $objFabrica->GetCantidadMaxima()) {
                                    echo '<td>'.'<h2>Ya no se pueden ingresar mas empleados, se ha superado la cantidad maxima</h2>'.'<td>';
                                }
                    }
                    // foreach ($resultado as $value) {
                    //     $objEmpleado = new Empleado($value["nombre"],$value["apellido"],$value["dni"],$value["sexo"],$value["legajo"],$value["sueldo"],$value["turno"],$value["pathfoto"]);  
                    //     $legajo = $objEmpleado->GetLegajo();
                    //     $pathFoto = $objEmpleado->GetPathFoto();
                    //     $objetoDni = $objEmpleado->GetDni();
                    //     $arrayEmpleados = $objFabrica->GetEmpleados();
                    //     array_push($arrayEmpleados,$objEmpleado);
                    //     echo '<tr>';
                    //             echo '<td style="font-weight: 300;font-size:18px;">'.$objEmpleado->ToString().'<td>';
                
                    //             echo '<td>'."<input type='button' onclick='Main.EliminarEmpleado(".$legajo.")' value='Eliminar'>".'<td>';
                    //             echo '<td>'."<img src='$pathFoto' alt=' ' width='90px' height='90px'>".'<td>';
                    //             echo '<td>'."<input type='button' onclick='Main.ModificarEmpleado(".$objetoDni.")' value='Modificar'>".'<td>';
                    //             echo '</tr>';
                    //             echo '<br>';
                    //             if (count($arrayEmpleados) == $objFabrica->GetCantidadMaxima()) {
                    //                 echo '<td>'.'<h2>Ya no se pueden ingresar mas empleados, se ha superado la cantidad maxima</h2>'.'<td>';
                    //             }
                    // }
                        
                    

                    // $size = filesize("archivos/empleados.txt");
                    // if (file_exists("archivos/empleados.txt") && filesize("archivos/empleados.txt") > 0) {  
                    //     $archivo = fopen("archivos/empleados.txt","r");
                    //     $objFabrica = new Fabrica('Marvel');
                    //     $arrayEmpleados = $objFabrica->GetEmpleados();
                    //     while(!feof($archivo)) {
                    //         if(feof($archivo)){//depurar
                    //             break;
                    //         }
                    //         $archivotxt = fgets($archivo);
                    //         $arrayEmpleadosExplode = explode('-',$archivotxt);
                    //         if ($arrayEmpleadosExplode[0] != "") {//ver
                    //             $objEmpleado = new Empleado($arrayEmpleadosExplode[0],$arrayEmpleadosExplode[1],$arrayEmpleadosExplode[2],$arrayEmpleadosExplode[3],$arrayEmpleadosExplode[4],$arrayEmpleadosExplode[5],$arrayEmpleadosExplode[6],$arrayEmpleadosExplode[7]);
                    //             array_push($arrayEmpleados,$objEmpleado);

                    //             $legajo = $objEmpleado->GetLegajo();
                    //             $pathFoto = $objEmpleado->GetPathFoto();
                    //             $objetoDni = $objEmpleado->GetDni();
                    //             echo '<tr>';
                    //             echo '<td style="font-weight: 300;font-size:18px;">'.$objEmpleado->ToString().'<td>';
                
                    //             echo '<td>'."<input type='button' onclick='Main.EliminarEmpleado(".$legajo.")' value='Eliminar'>".'<td>';
                    //             echo '<td>'."<img src='$pathFoto' alt=' ' width='90px' height='90px'>".'<td>';
                    //             echo '<td>'."<input type='button' onclick='Main.ModificarEmpleado(".$objetoDni.")' value='Modificar'>".'<td>';
                    //             echo '</tr>';
                    //             echo '<br>';
                    //             if (count($arrayEmpleados) == $objFabrica->GetCantidadMaxima()) {
                    //                 echo '<td>'.'<h2>Ya no se pueden ingresar mas empleados, se ha superado la cantidad maxima</h2>'.'<td>';
                    //             }
                    //         }
                    //     }
            
                    //     fclose($archivo);
                        
                    // }else{
                    //     echo '<td><td style="font-weight: 500;font-size:30px;">El archivo se encuentra vacio<td><td>';
                    // }
                    
                    ?>
                </thead>
            </tbody>
        </table>
        <hr>
</body>
</html>