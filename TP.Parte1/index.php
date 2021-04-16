<?php
    if(isset(($_POST['txtHidden']))){
        include('Fabrica.php');
        $dniPOST = $_POST['txtHidden'];
        $objFabrica = new Fabrica('Riot');
        $objFabrica->TraerDeArchivo('archivos/empleados.txt');
        $empleados = $objFabrica->GetEmpleados();
        foreach ($empleados as $key => $valueObj) {
            if ($valueObj->GetDni() == $dniPOST) {
                $objEmpleado = $valueObj;
                break;
            }     
        }
        $checkedM = '';
        $checkedT = '';
        $checkedN = '';
        if($objEmpleado->GetTurno()=='Mañana'){
            $checkedM = 'checked';
        }
        if($objEmpleado->GetTurno()=='Tarde'){
            $checkedT = 'checked';
        }
        if($objEmpleado->GetTurno()=='Noche'){
            $checkedN = 'checked';
        }
    
        
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>HTML 5 – Formulario Modificar Empleado</title>
            <script src="javascript/funciones.js"></script>
        </head>
        <body>
            <h2>Modificar Empleado</h2>
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
                                <input id="txtDni" type="number" min="1000000" max="55000000" name="txtDni" value='.$objEmpleado->GetDni().' readonly/><span id="spanDni" style="display: none;"> * </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Apellido:</td>
                            <td  style="text-align:left;padding-left:15px">
                                <input id="apellido" type="text" name="txtApellido" value='.$objEmpleado->GetApellido().' /><span id="spanApellido" style="display: none;"> * </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Nombre:</td>
                            <td  style="text-align:left;padding-left:15px">
                                <input id="nombre" type="text" name="txtNombre" value='.$objEmpleado->GetNombre().' /><span id="spanNombre" style="display: none;"> * </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Sexo:</td>
                            <td style="text-align:left;padding-left:15px">
                                <select id="cboSexo" name="cboSexo">
                                    <option value='.$objEmpleado->GetSexo().'>Seleccione</option>
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
                                <input type="number" min="100" max="550" name="txtLegajo" value='.$objEmpleado->GetLegajo().' id="txtLegajo" readonly/><span id="spanLegajo" style="display: none;"> * </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Sueldo:</td>
                            <td  style="text-align:left;padding-left:15px">
                                <input type="number" min="8000" max="20000" step="500" name="txtSueldo" value='.$objEmpleado->GetSueldo().' id="txtSueldo" /><span id="spanSueldo" style="display: none;"> * </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Turno:</td>
                            <tr>					
                                <td  style="text-align:right;padding-left:15px">
                                    <input type="radio" name="rdoTurno" value="Mañana" checked='.$checkedM.' /><span id="spanTurno" style="display: none;"> * </span>						
                                </td>
                                <td style="text-align: left;">Ma&ntilde;ana</td>
                            </tr>
                            <tr>
                                <td  style="text-align:right;padding-left:15px">
                                    <input type="radio" name="rdoTurno" value="Tarde" checked='.$checkedT.'/>						
                                </td>
                                <td style="text-align: left;">Tarde</td>
                            </tr>
                            <tr>
                                <td  style="text-align:right;padding-left:15px">
                                    <input type="radio" name="rdoTurno" value="Noche" checked='.$checkedN.'/>						
                                </td>
                                <td style="text-align: left;">Noche</td>
                            </tr>
                                    
                        </tr>
                        <tr>
                            <td>Foto: </td>
                            <td><input type="file" name="archivo" id="file" value='.$objEmpleado->GetPathFoto().'><span id="spanFile" style="display: none;"> * </span>
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
                                <input type="submit" onclick="AdministrarValidaciones(event)" id="btnEnviar" value="Modificar" />
                            </td>
                        </tr>
                        <tr>
                            <input type="hidden" id="hdnModificar" name="hdnModificar" value='.$objEmpleado->GetDni().'/>
                        </tr>

                    </thead>       
                </tbody>
            </table>
            </form>
            
        </body>
        </html>';
        
    }else{

        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>HTML 5 – Formulario Alta Empleado</title>
            <script src="javascript/funciones.js"></script>
        </head>
        <body>
            <h2>Alta Empleado</h2>
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
                    </thead>       
                </tbody>
            </table>
            </form>
            
        </body>
        </html>';
        
    }

?>
