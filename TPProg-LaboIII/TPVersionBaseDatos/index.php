<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="CSS/estilosLogin.css">
    <title>HTML5 - Formulario Login</title>
    
    <script src="javascript/funcionesLogin.js"></script>
    
    
</head>
<body>
    <h2>Login</h2>
    <form action="backend/verificarUsuario_pdo.php" method="POST">
        <table align="center">
            <tr>
                <th colspan="2"><h4>Ingreso de creedenciales<hr></h4></th>
            </tr>
            <tr>
                <td style="color:red;">DNI: </td>
                <td class="input"><input type="number" name="txtDni" id="txtDni" min="1000000" max="55000000"><span id="spanDni" style="display: none;"> * </span></td>
            </tr>
            <tr>
                <td>Apellido: </td>
                <td class="input"><input type="text" id="txtApellido" name="txtApellido"><span id="spanApellido" style="display: none;"> * </span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr><input type="reset" value="Limpiar" name="btnLimpiar">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="btnEnviar" id="btnEnviar" onclick="AdministrarValidacionesLogin(event)"><br><br>
                    <span class="material-icons">logout</span>
                </td>
            </tr>
        </table>
    </form>
    
</body>
</html>