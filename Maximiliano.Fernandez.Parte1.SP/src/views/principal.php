{% extends 'principal.html' %}

{% block content %}
<body class="bg-primary">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Principal</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Alta Auto</a>
                        </li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Listados
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><button class="dropdown-item" id="btnAutos">Autos</button></li>
                            <li><button class="dropdown-item" id="btnUsuarios">Usuarios</button></li>
                        </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="tableUser">

        </div>
        <div id="danger">

        </div>
    </div>

    
</body>
{% endblock %}