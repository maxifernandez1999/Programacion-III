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
            //AGREGAR JSON
            var paramJson = "obj_json=" + ("{\"txtNombre\":\"" + nombre + "\",\"txtApellido\":\"" + apellido + "\",\"txtDni\":" + dni + ",\"cboSexo\":\"" + sexo + "\",\"txtLegajo\":" + legajo + ",\"txtSueldo\":" + sueldo + ",\"rdoTurno\":\"" + turnoSeleccionado + "\"}");
            ajax.Post("../backend/administracion_pdo.php", ReponseSend, paramJson, foto, true, Errores);
            document.getElementById('titulo').innerHTML = "Alta Empleado";
        }
    }
    Main.AltaEmpleado = AltaEmpleado;
    function EliminarEmpleado(legajo, id) {
        ajax.Get("../backend/eliminar_pdo.php", ResponseEliminar, "txtLegajo=" + legajo + "&" + "id=" + id, true, Errores);
    }
    Main.EliminarEmpleado = EliminarEmpleado;
    function ModificarEmpleado(dni) {
        ajax.Get("../backend/modificar_pdo.php", ResponseModificar, "txtDni=" + dni, true, Errores);
        document.getElementById('titulo').innerHTML = "Modificar Empleado";
    }
    Main.ModificarEmpleado = ModificarEmpleado;
    function MostrarEmpleados() {
        ajax.Get("../backend/mostrar_pdo.php", ResponseShow, "", true, Errores);
    }
    Main.MostrarEmpleados = MostrarEmpleados;
    function ResponseEliminar(responseText) {
        console.log(responseText);
        MostrarEmpleados();
    }
    function ResponseModificar(responseText) {
        //alert(responseText);
        var objJSON = JSON.parse(responseText);
        //var arrayResponse:string[] = responseText.split("-");
        console.log(responseText);
        document.getElementById('Nombre').value = objJSON.nombre;
        document.getElementById('apellido').value = objJSON.apellido;
        document.getElementById('txtDni').value = objJSON.dni;
        document.getElementById('txtDni').readOnly = true;
        document.getElementById('cboSexo').value = objJSON.sexo;
        document.getElementById('txtLegajo').value = objJSON.legajo;
        document.getElementById('txtLegajo').readOnly = true;
        document.getElementById('txtSueldo').value = objJSON.sueldo;
        var turno = document.getElementsByName('rdoTurno');
        for (var index = 0; index < turno.length; index++) {
            if (turno[index].value == objJSON.turno) {
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
