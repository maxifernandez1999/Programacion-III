<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="login_pdo.php" method="post">
        <table>
        <tr>
            <th>ABM</th>
        </tr>
        <tr>
            <td>OPCION</td>
            <td><input type="text" name="opcion" id="" value=""></td>
        </tr>
        <tr>
            <td>CORREO</td>
            <td><input type="text" name="correo" id="" value=""></td>
        </tr>
        <tr>
            <td>CLAVE</td>
            <td><input type="text" name="clave" id="" value=""></td>
        </tr>
        <tr>
            <td>ID</td>
            <td><input type="text" name="id" id="" value=""></td>
        </tr>
        <tr>
            <td>OBJJSON</td>
            <td><input type="text" name="obj_json" id="" value=""></td>
            <td><h2 style="font-size: 20px;">Json para copiar: {"correo":"hola123@hola.com","clave":"hola123","nombre":"pepe","perfil":2}</h2></td>
        </tr>
        <tr>
            <td><input type="submit"></td>
        </tr>
        </table>     
    </form>
    
</body>
</html>