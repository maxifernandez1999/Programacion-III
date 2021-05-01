function AdministrarModificar(dni) {
    document.getElementById('txtHidden').value = dni;
    document.getElementById("FormModificar").submit();
}
//FUNCION QUE ADMINISTRA LAS VALIDACIONES
function AdministrarValidaciones() {
    var checked = true;
    //validaciones campos vacios
    if (!ValidarCamposVacios(document.getElementById('archivo').value)) {
        var elementoSpan = document.getElementById('spanFile');
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        checked = false;
    }
    if (!ValidarCamposVacios(document.getElementById('txtDni').value)) {
        var elementoSpan = document.getElementById('spanDni');
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        checked = false;
    }
    if (!ValidarCamposVacios(document.getElementById('Nombre').value)) {
        var elementoSpan = document.getElementById('spanNombre');
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        checked = false;
    }
    if (!ValidarCamposVacios(document.getElementById('apellido').value)) {
        var elementoSpan = document.getElementById('spanApellido');
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        checked = false;
    }
    if (!ValidarCamposVacios(document.getElementById('txtLegajo').value)) {
        var elementoSpan = document.getElementById('spanLegajo');
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        checked = false;
    }
    if (!ValidarCamposVacios(document.getElementById('txtSueldo').value)) {
        var elementoSpan = document.getElementById('spanSueldo');
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        checked = false;
    }
    //validacion rango numerico
    //DNI
    var numeroValidarDni = parseInt(document.getElementById('txtDni').value);
    var numeroMinDni = parseInt(document.getElementById('txtDni').min);
    var numeroMaxDni = parseInt(document.getElementById('txtDni').max);
    if (!ValidarRangoNumerico(numeroValidarDni, numeroMinDni, numeroMaxDni)) {
        var elementoSpan = document.getElementById('spanDni');
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        checked = false;
    }
    //LEGAJO
    var numeroValidarLegajo = parseInt(document.getElementById('txtLegajo').value);
    var numeroMinLegajo = parseInt(document.getElementById('txtLegajo').min);
    var numeroMaxLegajo = parseInt(document.getElementById('txtLegajo').max);
    if (!ValidarRangoNumerico(numeroValidarLegajo, numeroMinLegajo, numeroMaxLegajo)) {
        var elementoSpan = document.getElementById('spanLegajo');
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        checked = false;
    }
    //SUELDO
    var numeroValidarSueldo = parseInt(document.getElementById('txtSueldo').value);
    var numeroMinSueldo = parseInt(document.getElementById('txtSueldo').min);
    var numeroMaxSueldo = ObtenerSueldoMaximo(ObtenerTurnoSeleccionado());
    if (!ValidarRangoNumerico(numeroValidarSueldo, numeroMinSueldo, numeroMaxSueldo)) {
        var elementoSpan = document.getElementById('spanLegajo');
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        checked = false;
    }
    //validar combobox
    var valorCombo = document.getElementById('cboSexo').value;
    if (!ValidarCombo(valorCombo, '---')) {
        var elementoSpan = document.getElementById('spanCboSexo');
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        checked = false;
    }
    return checked;
}
