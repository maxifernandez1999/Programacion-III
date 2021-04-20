<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina principal - AJAX</title>
</head>
<body style="background-color: beige;">
    <div style="background-color: chocolate;" id="nombre">Maximiliano Fernandez</div>
    <div style="background-color:coral;" id="form-list">
        <div style="background-color:darkgrey;float:left;position:relative;width:30%;" id="formulario">
            <form action="administracion.php" method="POST" enctype="multipart/form-data">
                <table align="center">
                    <tbody>
                        <thead>
                            <tr>
                                <th colspan="2"><h4>Datos Personales</h4><hr></tr>
                            </tr>
                            <tr>
                                <td>DNI:</td>
                                <td  style="text-align:left;padding-left:15px">
                                    <input id="txtDni" type="number" min="1000000" max="55000000" name="txtDni" value="" /><span id="spanDni" style="display: none;"> * </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Apellido:</td>
                                <td  style="text-align:left;padding-left:15px">
                                    <input id="apellido" type="text" name="txtApellido" value="" /><span id="spanApellido" style="display: none;"> * </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Nombre:</td>
                                <td  style="text-align:left;padding-left:15px">
                                    <input id="nombre" type="text" name="txtNombre" value="" /><span id="spanNombre" style="display: none;"> * </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Sexo:</td>
                                <td style="text-align:left;padding-left:15px">
                                    <select id="cboSexo" name="cboSexo">
                                        <option value="---">Seleccione</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                    </select><span id="spanCboSexo" style="display: none;"> * </span>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="2"><h4>Datos Laborales</h4><hr></th>
                            </tr>
                            <tr>
                                <td>Legajo:</td>
                                <td  style="text-align:left;padding-left:15px">
                                    <input type="number" min="100" max="550" name="txtLegajo" value="" id="txtLegajo" /><span id="spanLegajo" style="display: none;"> * </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Sueldo:</td>
                                <td  style="text-align:left;padding-left:15px">
                                    <input type="number" min="8000" max="20000" step="500" name="txtSueldo" value="" id="txtSueldo" /><span id="spanSueldo" style="display: none;"> * </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Turno:</td>
                                <tr>					
                                    <td  style="text-align:right;padding-left:15px">
                                        <input type="radio" name="rdoTurno" value="Mañana" checked="checked" /><span id="spanTurno" style="display: none;"> * </span>						
                                    </td>
                                    <td style="text-align: left;">Ma&ntilde;ana</td>
                                </tr>
                                <tr>
                                    <td  style="text-align:right;padding-left:15px">
                                        <input type="radio" name="rdoTurno" value="Tarde" />						
                                    </td>
                                    <td style="text-align: left;">Tarde</td>
                                </tr>
                                <tr>
                                    <td  style="text-align:right;padding-left:15px">
                                        <input type="radio" name="rdoTurno" value="Noche" />						
                                    </td>
                                    <td style="text-align: left;">Noche</td>
                                </tr>
                                        
                            </tr>
                            <tr>
                                <td>Foto: </td>
                                <td><input type="file" name="archivo" id="file"><span id="spanFile" style="display: none;"> * </span>
                                </td>
                            </tr>
                            <tr><td colspan="2"><hr></td></tr>
                            <tr>
                                <td colspan="2" align="right">
                                    <input type="reset" value="Limpiar" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right">
                                    <input type="submit" onclick="AdministrarValidaciones(event)" id="btnEnviar" value="Enviar" />
                                </td>
                            </tr>
                            <tr>
                                <input type="hidden" id="hdnModificar" name="hdnModificar" />
                            </tr>
                        </thead>       
                    </tbody>
                </table>
                </form>
        </div>
        <div style="background-color:darkkhaki;float:left;position:relative;width:70%;" id="listado">
            <h2>Listado de Empleados</h2>
        <table align="center">
        <form action="index.php" method="POST" id="FormModificar">
            <input type="hidden" name="txtHidden" id="txtHidden">
        </form>
            <section style="text-align:center;"><h4>Info</h4></section>
            <?php
            include_once('Empleado.php');
            include_once('Fabrica.php');
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
        </div>
    </div>
    <div style="background-color: chocolate;position:relative;float:left;" id="links"><a href='backend/cerrarSesion.php'>desloguearse</a></div>
</body>
</html>