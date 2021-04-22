/// <reference path="ajax.ts" />
/// <reference path="validaciones.ts" />
/// <reference path="administrarValidaciones.ts" />
// window.onload = ():void => {
//     Main.MostrarEmpleados();
// }; 
var Main;
(function (Main) {
    var ajax = new Ajax();
    function AltaEmpleado() {
        if (AdministrarValidaciones()) {
            var nombre = document.getElementById('Nombre').value; //cambio la mayuscula
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
            var parametros = "txtNombre=" + nombre + "?" + "txtApellido=" + apellido + "?" + "txtDni=" + dni + "?" + "CboSexo=" + sexo + "?" + "txtLegajo=" + legajo + "?" + "txtSueldo=" + sueldo + "?" + "rdoTurno=" + turnoSeleccionado;
            ajax.Post("http://localhost/Programacion-III/TPProgramacionIII/administracion.php", ReponseSend, parametros, foto, true, Errores);
        }
    }
    Main.AltaEmpleado = AltaEmpleado;
    function EliminarEmpleado(legajo) {
        ajax.Get("http://localhost/Programacion-III/TPProgramacionIII/eliminar.php", ResponseEliminar, "txtLegajo=" + legajo, true, Errores);
    }
    Main.EliminarEmpleado = EliminarEmpleado;
    function ModificarEmpleado(dni) {
        ajax.Get("http://localhost/Programacion-III/TPProgramacionIII/modificar.php", ResponseModificar, "txtDni=" + dni, true, Errores);
    }
    Main.ModificarEmpleado = ModificarEmpleado;
    function MostrarEmpleados() {
        ajax.Get("http://localhost/Programacion-III/TPProgramacionIII/mostrar.php", ResponseShow, "", true, Errores);
    }
    Main.MostrarEmpleados = MostrarEmpleados;
    function ResponseEliminar(responseText) {
        alert(responseText);
        MostrarEmpleados();
    }
    function ResponseModificar(responseText) {
        var arrayResponse = responseText.split("-");
        alert(responseText);
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
        //(<HTMLInputElement> document.getElementById('archivo')).value = arrayResponse[7];
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
