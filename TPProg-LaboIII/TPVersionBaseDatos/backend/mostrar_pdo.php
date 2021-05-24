<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/estilosMostrar.css">
    <script src="../javascript/funciones.js"></script>
    <script src="../javascript/ajax.js" ></script>
    <script src="../javascript/appAjax.js" ></script>
    <title>HTML5 - Listado de Empleados</title>
</head>
<body> 
    <h2>Listado de Empleados</h2>
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
                    include_once('../PHPFunctions/tablaHTML.php');
                    $objFabrica = new Fabrica("xd");
                    $consulta = $objFabrica->SelectEmpleados();
                    $TABLA = '<table align="center" id="tabla">';
                    $HEAD = '<tr text-align:center;">
                <th>NOMBRE</th>
                <th>APELLIDO</th>
                <th>DNI</th>
                <th>SEXO</th>
                <th>LEGAJO</th>
                <th>SUELDO</th>
                <th>TURNO</th>
                <th>PATHFOTO</th>
                <th>FOTO</th>
                <th colspan="2">ACCIONES</th>
            </tr>';
            $TD = "";
                    while($obj = $consulta->fetch(PDO::FETCH_OBJ)){
                        $objEmpleado = new Empleado($obj->nombre,$obj->apellido,$obj->dni,$obj->sexo,$obj->legajo,$obj->sueldo,$obj->turno,$obj->pathfoto);  
                        $arrayEmpleados = $objFabrica->GetEmpleados();
                        array_push($arrayEmpleados,$objEmpleado);
                        $TD .= '<tr>
        <td>'.$obj->nombre.'</td>
        <td>'.$obj->apellido.'</td>
        <td>'.$obj->dni.'</td>
        <td>'.$obj->sexo.'</td>
        <td>'.$obj->legajo.'</td>
        <td>'.$obj->sueldo.'</td>
        <td>'.$obj->turno.'</td>
        <td>'.$obj->pathfoto.'</td>
        <td><img src='. $obj->pathfoto.' width="100px" height="100px"></td>
        <td><input type="button" onclick="Main.EliminarEmpleado('.$obj->legajo.','.$obj->id.')" value="Eliminar"><br><input type="button" onclick="Main.ModificarEmpleado('.$obj->dni.')" value="Modificar"><td>
        </tr>';
        if (count($arrayEmpleados) == $objFabrica->GetCantidadMaxima()) {
            echo '<td>'.'<h2>Ya no se pueden ingresar mas empleados, se ha superado la cantidad maxima</h2>'.'<td>';
            }
        }
        echo $TABLA.$HEAD.$TD.'</table>';         
                   ?>
                </thead>
            </tbody>
        </table>
        <hr>
</body>
</html>