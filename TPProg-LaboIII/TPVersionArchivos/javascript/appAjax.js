/// <reference path="ajax.ts" />
/// <reference path="validaciones.ts" />
/// <reference path="administrarValidaciones.ts" />
var Main;
(function (Main) {
    var ajax = new Ajax();
    function Reset() {
        document.getElementById('reset').reset;
    }
    Main.Reset = Reset;
    function AltaEmpleado() {
        if (AdministrarValidaciones()) {
            var nombre = document.getElementById('Nombre').value;
            var apellido = document.getElementById('apellido').value;
            var dni = document.getElementById('txtDni').value;
            var sexo = document.getElementById('cboSexo').value;
            var legajo = document.getElementById('txtLegajo').value;
            var sueldo = document.getElementById('txtSueldo').value;
            var turno = document.getElementsByName('rdoTurno');
            for (var index = 0; index < turno.length; index++) {
                if (turno[index].checked) {
                    var turnoSeleccionado = turno[index].value;
                    break;
                }
            }
            var foto = document.getElementById('archivo');
            document.getElementById('txtDni').readOnly = false;
            document.getElementById('txtLegajo').readOnly = false;
            var parametros = "txtNombre=" + nombre + "?" + "txtApellido=" + apellido + "?" + "txtDni=" + dni + "?" + "cboSexo=" + sexo + "?" + "txtLegajo=" + legajo + "?" + "txtSueldo=" + sueldo + "?" + "rdoTurno=" + turnoSeleccionado;
            ajax.Post("./administracion.php", ReponseSend, parametros, foto, true, Errores);
            document.getElementById('titulo').innerHTML = "Alta Empleado";
        }
    }
    Main.AltaEmpleado = AltaEmpleado;
    function EliminarEmpleado(legajo) {
        ajax.Get("./eliminar.php", ResponseEliminar, "txtLegajo=" + legajo, true, Errores);
    }
    Main.EliminarEmpleado = EliminarEmpleado;
    function ModificarEmpleado(dni) {
        ajax.Get("./modificar.php", ResponseModificar, "txtDni=" + dni, true, Errores);
        document.getElementById('titulo').innerHTML = "Modificar Empleado";
    }
    Main.ModificarEmpleado = ModificarEmpleado;
    function MostrarEmpleados() {
        ajax.Get("./mostrar.php", ResponseShow, "", true, Errores);
    }
    Main.MostrarEmpleados = MostrarEmpleados;
    function ResponseEliminar(responseText) {
        console.log(responseText);
        MostrarEmpleados();
    }
    function ResponseModificar(responseText) {
        var arrayResponse = responseText.split("-");
        console.log(responseText);
        document.getElementById('Nombre').value = arrayResponse[0];
        document.getElementById('apellido').value = arrayResponse[1];
        document.getElementById('txtDni').value = arrayResponse[2];
        document.getElementById('txtDni').readOnly = true;
        document.getElementById('cboSexo').value = arrayResponse[3];
        document.getElementById('txtLegajo').value = arrayResponse[4];
        document.getElementById('txtLegajo').readOnly = true;
        document.getElementById('txtSueldo').value = arrayResponse[5];
        var turno = document.getElementsByName('rdoTurno');
        for (var index = 0; index < turno.length; index++) {
            if (turno[index].value == arrayResponse[6]) {
                turno[index].checked = true;
                break;
            }
        }
        MostrarEmpleados();
    }
    function ReponseSend(responseText) {
        console.log(responseText);
        MostrarEmpleados();
    }
    function ResponseShow(reponseText) {
        document.getElementById('cont-listado').innerHTML = reponseText;
    }
    function Errores(status) {
        console.log(status.toString());
    }
})(Main || (Main = {}));
