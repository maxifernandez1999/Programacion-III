<?php
    include('validarSesion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/estilosPrincipal.css">
    <title>Maximiliano Fernandez</title>
</head>
<body>
    <div id="tablas">
        <table style="width: 100%;height: 90%;">
            <tr><td colspan="2">Maximiliano Fernandez</td></tr>
            <tr>
            <tr></tr>
                <td><?php include('index_form.php') ?></td>
                <td id="cont-listado"><?php include('mostrar_pdo.php') ?></td>
            </tr>
        </table>
    </div>
    <br>
    <div id="links">
    <a style="font-size:large;color:black;font-weight:500;text-decoration:none;padding:20px;margin:20px;" href="cerrarSesion.php">Desloguearse</a>
    <a style="font-size:large;color:black;font-weight:500;text-decoration:none;padding:20px;margin:20px;" href="pdf.php">Crear PDF</a>
    <hr>
    </div>

</body>
</html>