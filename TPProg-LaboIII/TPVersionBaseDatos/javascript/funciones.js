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
function ValidarCamposVacios(campo) {
    if (campo != undefined) {
        if (campo.length != 0) {
            return true;
        }
    }
    else {
        return false;
    }
}
function ValidarRangoNumerico(numValidar, min, max) {
    if (numValidar >= min && numValidar <= max) {
        return true;
    }
    else {
        return false;
    }
}
function ValidarCombo(valorCorrecto, valorIncorrecto) {
    if (valorCorrecto != valorIncorrecto) {
        return true;
    }
    else {
        return false;
    }
}
function ObtenerTurnoSeleccionado() {
    var coleccion = document.getElementsByName('rdoTurno');
    var retorno = '';
    for (var index = 0; index < coleccion.length; index++) {
        var elemento = coleccion[index];
        if (elemento.checked) {
            var valorElemento = elemento.value;
            retorno = valorElemento;
            break;
        }
    }
    return retorno;
}
function ObtenerSueldoMaximo(turno) {
    var retorno = 0;
    switch (turno) {
        case 'Mañana':
            retorno = 20000;
            //(<HTMLInputElement>document.getElementById('Sueldo')).max = '20000';
            break;
        case 'Tarde':
            retorno = 18500;
            //(<HTMLInputElement>document.getElementById('Sueldo')).min = '18500';
            break;
        case 'Noche':
            retorno = 25000;
            //(<HTMLInputElement>document.getElementById('Sueldo')).max = '25000';
            break;
        default:
            break;
    }
    return retorno;
}
