{% extends 'principal.html' %}

{% block content %}
<body class="bg-primary">
    <div class="container">
        <div class="row">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Listados
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><button class="dropdown-item" id="btnPerfiles">Perfiles</button></li>
                                <li><button class="dropdown-item" id="btnUsuarios">Usuarios</button></li>
                            </ul>
                        </li>
                        
                        <li class="nav-item">
                            <!-- <a class="nav-link active" aria-current="page" href="#" id="agregarPerfil">Alta Perfil</a> -->
                            <button type="button" class="btn btn-info nav-link active" data-bs-toggle="modal" data-bs-target="#staticBackdrop" aria-current="page" id="agregarPerfil">
  AltaPerfil
</button>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#" id="filter">Filter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#" id="map">Map</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#" id="reduce">Reduce</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#" id="deleteUser">EliminarUsuario</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        </div>
        
        <div class="row">
            <div class="col bg-danger" id="tablePerfiles">
                Izquierda
            </div>
            <div class="col bg-dark" id="tableUser">
                Derecha
            </div>
        </div>
        <div id="alertPrincipal"></div>




<!-- Modal Modificar -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
  <div class="modal-dialog">
     <div class="modal-content">
         <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modificacion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- descripcion -->
        <div class="m-3">
                <label for="exampleInputEmail1" class="form-label">Descripcion</label>
                <i class="fas fa-trademark"></i>
                <input type="text" class="form-control" id="descripcionModificar" aria-describedby="emailHelp">
        </div>
        <!-- estado -->
        <div class="m-3">
        <label for="exampleInputPassword1" class="form-label">Perfil</label>
        <i class="fas fa-id-card"></i>
        <select class="form-select form-select-lg mb-3 far fa-id-card" aria-label=".form-select-lg example" id="estadoModificar">
            <option value="1" selected>Activo</option>
            <option value="0">Inactivo</option>
        </select>
        </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="buttonOK" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div> 
</div>

<!-- Button trigger modal -->


<!-- Modal Agregar-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Alta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- descripcion -->
        <div class="m-3">
                <label for="exampleInputEmail1" class="form-label">Descripcion</label>
                <i class="fas fa-trademark"></i>
                <input type="text" class="form-control" id="descripcionAlta" aria-describedby="emailHelp">
        </div>
        <!-- estado -->
        <div class="m-3">
        <label for="exampleInputPassword1" class="form-label">Perfil</label>
        <i class="fas fa-id-card"></i>
        <select class="form-select form-select-lg mb-3 far fa-id-card" aria-label=".form-select-lg example" id="estadoAlta">
            <option value="1" selected>Activo</option>
            <option value="0">Inactivo</option>
        </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnOKAlta" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

    </div>

    
</body>
{% endblock %}