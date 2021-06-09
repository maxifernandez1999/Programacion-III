       <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!--dps eliminar estos link-->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--<link rel="stylesheet" href="../CSS/estilosPrincipal.css">-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="javascript/funcionesLogin.js"></script>
            <!--<link rel="stylesheet" href="../CSS/estilosForm.css">-->
            <title>HTML 5 – Formulario Alta Empleado</title>
            <script src="../javascript/funciones.js"></script>
            <script src="../javascript/ajax.js" ></script>
            <script src="../javascript/appAjax.js" ></script>
        </head>
        <body>
            <div class="container">

       


    <!--     <div class="col-md-4"><label for="validationCustom01" class="form-label">First name</label>
    <input type="text" class="form-control" id="validationCustom01" value="Mark" required>
    <div class="valid-feedback">
      Looks good!
    </div>-->

    <!-- -->
      
            <form class="was-validated" id="reset" >
                <h2 id="titulo">Alta Empleado</h2>
                <h4>Datos Personales</h4><hr>
                    <div class="form-group">
                        <label for="uname">DNI:</label>
                        <input id="txtDni" type="number" min="1000000" max="55000000" class="form-control" id="uname" placeholder="Ingresar usuario" name="uname"
                            required>
                            <span id="spanDni" style="display: none;"> * </span>
                        <div class="valid-feedback">Válido.</div>
                        <div class="invalid-feedback">DNI requerido.</div>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Apellido:</label>
                        <input id="apellido" type="text" name="txtApellido" class="form-control" id="pwd" placeholder="Ingresar contraseña"
                            name="pswd" required>
                            <span id="spanApellido" style="display: none;"> * </span>
                        <div class="valid-feedback">Válido.</div>
                        <div class="invalid-feedback">Apellido requerido.</div>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Nombre:</label>
                        <input id="Nombre" type="text" name="txtNombre" class="form-control" id="pwd" placeholder="Ingresar contraseña"
                            name="pswd" required>
                            <span id="spanNombre" style="display: none;"> * </span>
                        <div class="valid-feedback">Válido.</div>
                        <div class="invalid-feedback">Nombre requerido.</div>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Sexo:</label>
                        <select id="cboSexo" name="cboSexo" class="form-select" aria-label="Default select example">
                        <option value="---" selected>Seleccione</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                    <span id="spanCboSexo" style="display: none;"> * </span>
                    </div>

     

                    <h4>Datos Laborales</h4><hr>
                    <div class="form-group">
                        <label for="uname">Legajo:</label>
                        <input id="txtLegajo" type="number" min="100" max="550" class="form-control" id="uname" name="txtLegajo" placeholder="Ingresar usuario" name="uname"
                            required>
                            <span id="spanLegajo" style="display: none;"> * </span>
                        <div class="valid-feedback">Válido.</div>
                        <div class="invalid-feedback">Legajo requerido.</div>
                    </div>
                    <div class="form-group">
                        <label for="uname">Sueldo:</label>
                        <input id="txtSueldo" step="500" type="number" min="8000" max="20000" class="form-control" id="uname" name="txtSueldo" placeholder="Ingresar usuario" name="uname"
                            required>
                            <span id="spanSueldo" style="display: none;"> * </span>
                        <div class="valid-feedback">Válido.</div>
                        <div class="invalid-feedback">Sueldo requerido.</div>
                    </div>


                    <!--<td>Turno:</td>
                            <tr>					
                                <td class="datosTurno">
                                    <input type="radio"   checked="checked" />						
                                </td>
                                <td class="turnoDescription">Ma&ntilde;ana</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio"  value="" />						
                                </td>
                                <td class="turnoDescription">Tarde</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" name="" value="" />						
                                </td>
                                <td class="turnoDescription">Noche</td>
                            </tr>-->
                            
                    <div class="form-group">
                        <label for="uname">Turno:</label>
                        <div class="form-check">
                    
                        <input class="form-check-input" type="radio" name="exampleRadios rdoTurno" id="exampleRadios1" value="Mañana" checked>
                        <label class="form-check-label" for="exampleRadios1">
                        Mañana
                        </label>
                        <span id="spanTurno" style="display: none;"> * </span>
                        </div>

                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios rdoTurno" id="exampleRadios1" value="Tarde">
                        <label class="form-check-label" for="exampleRadios1">
                        Tarde
                        </label>
                        </div>

                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios rdoTurno" id="exampleRadios3" value="Noche">
                        <label class="form-check-label" for="exampleRadios3">
                        Noche
                        </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="formFileSm" class="form-label">Foto:</label>
                        <input class="form-control form-control-sm" id="archivo" type="file" name="archivo">
                        <span id="spanFile" style="display: none;"> * </span>
                    </div>






                    <!--<td>Foto: </td>
                            <td><input type="file"  //id="archivo">
                            </td>-->

                            <!--<input type="reset" value="Limpiar"  />
                            <input type="button"   value="Enviar" />id="reset"-->
                            
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="reset" onclick="Main.Reset()">Limpiar</button>
                            <button class="btn btn-primary" type="button" onclick="Main.AltaEmpleado()" id="btnEnviar">Enviar</button>
                        </div>

                        </form>
                </div>
            <!--<form >
            <table id="tablaForm" align="center">
                <tbody>
                    <thead>
                        <tr>
                            <th colspan="2"></tr>
                        </tr>
                        <tr>
                            <td>DNI:</td>
                            
                        </tr>
                        <tr>
                            <td>Apellido:</td>
                            <td class="datos">
                                
                            </td>
                        </tr>
                        <tr>
                            <td>Nombre:</td>
                            <td class="datos">
                                
                            </td>
                        </tr>
                        <tr>
                            <td>Sexo:</td>
                            <td class="datos">
                                
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2"></th>
                        </tr>
                        <tr>
                            <td>Legajo:</td>
                            <td class="datos">
                                
                            </td>
                        </tr>
                        <tr>
                            <td>Sueldo:</td>
                            <td class="datos">
                                
                            </td>
                        </tr>
                        <tr>
                           
                                    
                        </tr>
                        <tr>
                            
                        </tr>
                        <tr><td colspan="2"><hr></td></tr>
                        <tr>
                            <td colspan="2" align="right">
                                
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right">
                                
                            </td>
                        </tr>
                    </thead>       
                </tbody>
            </table>
            </form>-->
            
        </body>
        </html>
        
