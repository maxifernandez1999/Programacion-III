{% extends 'login.html' %}

{% block content %}

<body>
<form>
    <div class="container p-3">
        <h1>Login</h1>
        <div class="container div p-3">
            <!-- email -->
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Correo</label>
                <i class="fas fa-envelope" style="background-color:lightgrey"></i>
                <input type="email" class="form-control" id="correoLogin" aria-describedby="emailHelp">
            </div>
            <!-- clave -->
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Clave</label>
                <i class="fas fa-key" style="background-color:lightgrey"></i>
                <input type="password" class="form-control" id="claveLogin">
            </div>
            <!-- enviar/limpiar -->
            <div class="mb-3 d-flex justify-content-around">
                <button class="btn btn-primary mr-5 col-md-5 col-sm-4 col-xs-12" type="button" id="btnEnviar">Enviar</button>
                <button class="btn btn-warning mr-5 col-md-5 col-sm-4 col-xs-12" type="reset" id="btnLimpiar">Limpiar</button>
            </div>
            <!-- quiero registrarme -->
            <div class="mb-3 d-flex justify-content-around">
                <button class="btn btn-success col-md-7 ml-auto col-xs-12" type="button" id="btnLogin" name="registro" data-toggle="modal" data-target="#myModal">Quiero Registrarme!</button>
            </div>
        </div>
        <div id="alertLogin"><!--Alert message--></div>
            
    </div>
</form>
    
  
    

    <!-- <br> -->
    <!--alert de error-->
    <!-- <label class="col-md-2"></label>
    <div id="alertLogin" class="alert alert-warning col-md-8" role="alert" hidden>

    </div> -->

    <!--Modal-->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">REGISTRO</h4>
                </div>
                <div class="modal-body">
                    <!-- Form Registro-->
                    <form method="POST" id="formRegistro" class="form-horizontal" role="form">

                        <div class="form-group">
                            <label class="col-md-2 control-label">Apellido:</label>
                            <div class="col-md-10 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input name="apellido" id="apellido" placeholder="Apellido" class="form-control"
                                        type="text">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Nombre:</label>
                            <div class="col-md-10 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input name="nombre" id="nombre" placeholder="Nombre" class="form-control"
                                        type="text">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">E-mail:</label>
                            <div class="col-md-10 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input name="correo" id="correo" placeholder="Correo" class="form-control"
                                        type="text">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Perfil:</label>
                            <div class="col-md-10 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i
                                            class="glyphicon glyphicon-option-horizontal"></i></span>
                                    <select name="perfil" id="perfil" class="form-control">
                                        <option value="seleccione" selected>Seleccione</option>
                                        <option value="propietario">Propietario</option>
                                        <option value="encargado">Encargado</option>
                                        <option value="empleado">Empleado</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Foto:</label>
                            <div class="col-md-10 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-camera"></i></span>
                                    <input name="foto" id="foto" placeholder="Foto" class="form-control" type="file">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Clave:</label>
                            <div class="col-md-10 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input name="clave" id="clave" placeholder="Clave" class="form-control"
                                        type="password">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Confirmar:</label>
                            <div class="col-md-10 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input name="confirmar" id="confirmar" placeholder="Repita Clave"
                                        class="form-control" type="password">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-1"></div>
                            <button class="btn btn-info col-md-4" type="submit" id="enviarRegistro">Enviar</button>
                            <div class="col-md-2"></div>
                            <button class="btn btn-warning col-md-4" type="reset" id="limpiar">Limpiar</button>
                            <div class="col-md-1"></div>
                        </div>

                    </form>

                </div>
                <div id="alertRegister" class="alert alert-danger" role="alert" hidden></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body> 

{% endblock %}