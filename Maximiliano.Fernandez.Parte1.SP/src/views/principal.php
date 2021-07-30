{% extends 'principal.html' %}

{% block content %}
<body class="bg-primary">
    <div class="container">
        <div class="row">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#" id="logout">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        </div>
        <div class="row">
        <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" href="#" id="btnUsuarios">Listado Usuarios</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="#" id="btnAutos">Listado Autos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="#" id="AgregarAuto">AgregarAuto</a>
  </li>

</ul>
        </div>
        <div class="row">
            <div class="col bg-danger" id="tableAutos">
                Izquierda
            </div>
            <div class="col bg-dark" id="tableUser">
                Derecha
            </div>
        </div>
        <div class="danger"></div>
        
    </div>

    
</body>
{% endblock %}