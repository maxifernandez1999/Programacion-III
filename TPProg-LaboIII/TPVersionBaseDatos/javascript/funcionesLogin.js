function AdministrarValidacionesLogin(event) {
    var retorno = true;
    if (!ValidarCamposVacios(document.getElementById('txtApellido').value)) {
        var elementoSpan = document.getElementById('spanApellido');
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        retorno = false;
    }
    if (!ValidarCamposVacios(document.getElementById('txtDni').value)) {
        var elementoSpan = document.getElementById('spanDni');
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        retorno = false;
    }
    var numeroValidarDni = parseInt(document.getElementById('txtDni').value);
    var numeroMinDni = parseInt(document.getElementById('txtDni').min);
    var numeroMaxDni = parseInt(document.getElementById('txtDni').max);
    if (!ValidarRangoNumerico(numeroValidarDni, numeroMinDni, numeroMaxDni)) {
        var elementoSpan = document.getElementById('spanDni');
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        retorno = false;
    }
    if (retorno == false) {
        event.preventDefault();
    }
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
            break;
        case 'Tarde':
            retorno = 18500;
            break;
        case 'Noche':
            retorno = 25000;
            break;
        default:
            break;
    }
    return retorno;
}
