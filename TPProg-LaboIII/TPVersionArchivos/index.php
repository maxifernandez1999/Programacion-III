<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML5 - Formulario Login</title>
    <script src="javascript/funcionesLogin.js"></script>
</head>
<body style="background-image: url('./IMG/40781-river-plate.jpg');background-color: transparent;background-position:top;">
    <h2>Login</h2>
    <form action="backend/verificarUsuario.php" method="POST">
        <table align="center" >
            <tr>
                <th colspan="2"><h4 style="background-color:grey;font-size:30px;text-align:center;padding:2%;">Ingreso de creedenciales<hr></h4></th>
            </tr>
            <tr>
                <td style="color:red;">DNI: </td>
                <td style="text-align:left;padding-left:5px"><input type="number" name="txtDni" id="txtDni" min="1000000" max="55000000"><span id="spanDni" style="display: none;"> * </span></td>
            </tr>
            <tr>
                <td>Apellido: </td>
                <td style="text-align:left;padding-left:5px"><input type="text" id="txtApellido" name="txtApellido"><span id="spanApellido" style="display: none;"> * </span></td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <hr><input type="reset" value="Limpiar" name="btnLimpiar">
                </td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <input type="submit" name="btnEnviar" id="btnEnviar" onclick="AdministrarValidacionesLogin(event)">
                </td>
            </tr>
        </table>
    </form>
    
</body>
</html>