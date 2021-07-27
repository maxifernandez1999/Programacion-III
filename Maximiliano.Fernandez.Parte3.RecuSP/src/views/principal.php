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
        
    </div>

    
</body>
{% endblock %}