{% extends 'registro.html' %}

{% block content %}
<body>
    <div class="container" style="rgb(153,167,184);lightgrey;">
        <h1>REGISTRO</h1>
            <!-- email -->
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <i class="fas fa-envelope"></i>
                <input type="email" class="form-control" id="correo" aria-describedby="emailHelp">
            </div>
            <!-- clave -->
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <i class="fas fa-key"></i>
                <input type="password" class="form-control" id="clave">
            </div>
            <!-- nombre -->
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nombre</label>
                <i class="fas fa-user"></i>
                <input type="text" class="form-control" id="nombre">
            </div>
            <!-- apellido -->
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Apellido</label>
                <i class="fas fa-user"></i>
                <input type="text" class="form-control" id="apellido">
            </div>
            <!-- perfil -->
            <label for="exampleInputPassword1" class="form-label">Perfil</label>
            <i class="fas fa-id-card"></i>
            <select class="form-select form-select-lg mb-3 far fa-id-card" aria-label=".form-select-lg example" id="perfil">
                <option value="propietario" selected>propietario</option>
                <option value="encargado">encargado</option>
                <option value="empleado">empleado</option>
            </select>
            <!-- foto -->
            <div class="mb-3">
                <label for="formFile" class="form-label">Foto</label>
                <i class="fas fa-camera"></i>
                <input class="form-control" type="file" id="file">
            </div>
            <!-- buttons -->
            <div class="mb-3">
                <button class="btn btn-primary mr-5 col-md-5 col-sm-4 col-xs-12" type="button" id="btnRegistrar">Enviar</button>
                <button class="btn btn-warning mr-5 col-md-5 col-sm-4 col-xs-12" type="reset" id="btnLimpiar">Limpiar</button>
            </div>
    </div>
</body>
{% endblock %}