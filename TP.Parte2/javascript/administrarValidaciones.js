"use strict";
function AdministrarValidaciones() {
    //validaciones campos vacios
    //DNI
    if (!ValidarCamposVacios(document.getElementById('txtDni').value)) {
        alert('El campo DNI se encuentra vacio, por favor ingrese un Dni');
    }

    //NOMBRE
    if (!ValidarCamposVacios(document.getElementById('nombre').value)) {
        alert('El campo NOMBRE se encuentra vacio, por favor ingrese un nombre');
    }
    //APELLIDO
    if (!ValidarCamposVacios(document.getElementById('apellido').value)) {
        alert('El campo APELLIDO se encuentra vacio, por favor ingrese un apellido');
    }
    //LEGAJO
    if (!ValidarCamposVacios(document.getElementById('txtLegajo').value)) {
        alert('El campo LEGAJO se encuentra vacio, por favor ingrese un legajo');
    }
    //SUELDO
    if (!ValidarCamposVacios(document.getElementById('txtSueldo').value)) {
        alert('El campo SUELDO se encuentra vacio, por favor ingrese un sueldo');
    }
    //validacion rango numerico
    //DNI
    var numeroValidarDni = parseInt(document.getElementById('txtDni').value);
    var numeroMinDni = parseInt(document.getElementById('txtDni').min);
    var numeroMaxDni = parseInt(document.getElementById('txtDni').max);
    if (!ValidarRangoNumerico(numeroValidarDni, numeroMinDni, numeroMaxDni)) {
        alert('El valor del DNI no esta en el rango correcto');
    }
    //LEGAJO
    var numeroValidarLegajo = parseInt(document.getElementById('txtLegajo').value);
    var numeroMinLegajo = parseInt(document.getElementById('txtLegajo').min);
    var numeroMaxLegajo = parseInt(document.getElementById('txtLegajo').max);
    if (!ValidarRangoNumerico(numeroValidarLegajo, numeroMinLegajo, numeroMaxLegajo)) {
        alert('El valor del Legajo no esta en el rango correcto');
    }
    //SUELDO
    var numeroValidarSueldo = parseInt(document.getElementById('txtSueldo').value);
    var numeroMinSueldo = parseInt(document.getElementById('txtSueldo').min);
    var numeroMaxSueldo = ObtenerSueldoMaximo(ObtenerTurnoSeleccionado());
    if (!ValidarRangoNumerico(numeroValidarSueldo, numeroMinSueldo, numeroMaxSueldo)) {
        alert('El valor del Sueldo no esta en el rango correcto');
    }
    
    //validar combobox
    var valorCombo = document.getElementById('cboSexo').value;
    if (!ValidarCombo(valorCombo, '---')) {
        alert('NO ha seleccionado un sexo');
    }
}
//# sourceMappingURL=administrarValidaciones.js.map