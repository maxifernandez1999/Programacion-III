<?php
    //include('validarSesion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--<link rel="stylesheet" href="../CSS/estilosPrincipal.css">-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="javascript/funcionesLogin.js"></script>
    <title>Maximiliano Fernandez</title>
</head>
<body>
    <div id="container">
        <div class="row bg-success">
            <h2>Maximiliano Fernandez</h2>
        </div>
        <div class="row bg-light">
            <div class="col-sm-12 col-lg-4 col-md-4 bg-secondary">
                <?php include('index_form.php') ?>
            </div>
            <div class="col-sm-12 col-lg-8 col-md-8">
                <?php include('mostrar_pdo.php') ?>
            </div>
        </div>
        <div class="row bg-info">
            <div class="col-sm-12">
                <a href="cerrarSesion.php">Desloguearse</a>
                <a href="pdf.php">Crear PDF</a>
            </div>
        </div>
    </div>
    <div id="links">
    
    <hr>
    </div>

</body>
</html>