<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principal</title>
    <?php
        include('backend/validarSesion.php');
    ?>
</head>
<body>
    <div id="tablas">
        <table style="width: 100%;height: 90%;">
            <tr><td colspan="2" style="border: grey solid;text-align: center;color:white;background-color:black;font-weight: 500;font-size:30px;">Maximiliano Fernandez</td></tr>
            <tr>
            <tr style="text-align: center;"></tr>
                <td style="border: grey solid;margin:20px;padding:20px;"><?php include('index_form.php') ?></td>
                <td id="cont-listado" style="border: grey solid;margin:40px;padding:40px;"><?php include('mostrar_pdo.php') ?></td>
            </tr>
        </table>
    </div>
    <br>
    <div id="links">
    <a style="font-size:large;color:black;font-weight:500;text-decoration:none;padding:20px;margin:20px;" href="backend/cerrarSesion.php">Desloguearse</a>
        <hr>
    </div>

</body>
</html>