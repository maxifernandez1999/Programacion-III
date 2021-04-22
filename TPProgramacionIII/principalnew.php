<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>principal</title>
</head>
<body>
    <div id="tablas">
        <table style="border: indigo solid;">
            <tr>Maximiliano Fernandez</tr>
            <tr>
                <td style="border: indigo solid;"><?php include('index.php') ?></td>
                <td id="cont-listado" style="border: indigo solid;"><?php include('mostrar.php') ?></td>
            </tr>
        </table>
    </div>
    <div id="links">
        <a href='backend/cerrarSesion.php'>desloguearse</a>
        <hr>;
    </div>

</body>
</html>