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
                            <a class="nav-link active" aria-current="page" href="#">Alta Auto</a>
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
        <div class="alertPrincipal"></div>



        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <!-- descripcion -->
        <div class="m-3">
                <label for="exampleInputEmail1" class="form-label">Descripcion</label>
                <i class="fas fa-trademark"></i>
                <input type="text" class="form-control" id="descripcion" aria-describedby="emailHelp">
            </div>
            <!-- estado -->
            <div class="m-3">
            <label for="exampleInputPassword1" class="form-label">Perfil</label>
            <i class="fas fa-id-card"></i>
            <select class="form-select form-select-lg mb-3 far fa-id-card" aria-label=".form-select-lg example" id="estado">
                <option value="1" selected>Activo</option>
                <option value="0">Inactivo</option>
            </select>
            </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">OK</button>
      </div>
    </div>
  </div>
</div>



    </div>

    
</body>
{% endblock %}