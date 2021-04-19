function AdministrarValidacionesLogin() {
    if (!ValidarCamposVacios(document.getElementById('txtApellido').value)) {
        // alert('El campo APELLIDO se encuentra vacio, por favor ingrese un apellido');
        var elementoSpan = document.getElementById('spanApellido');
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
            
        }
        return false;
    }
    if (!ValidarCamposVacios(document.getElementById('txtDni').value)) {
        // alert('El campo DNI se encuentra vacio, por favor ingrese un Dni');
        var elementoSpan = document.getElementById('spanDni');
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
            
        }
        return false;
    }
    var numeroValidarDni = parseInt(document.getElementById('txtDni').value);
    var numeroMinDni = parseInt(document.getElementById('txtDni').min);
    var numeroMaxDni = parseInt(document.getElementById('txtDni').max);
    if (!ValidarRangoNumerico(numeroValidarDni, numeroMinDni, numeroMaxDni)) {
        var elementoSpan = document.getElementById('spanDni');
        elementoSpan.style.display = 'block';
        return false;
    }
}
function ValidarCamposVacios(campo) {
    if (campo.length != 0) {
        return true;
    }
    else {
        return false;
    }
}
function ValidarRangoNumerico(numValidar, min, max) {
    if (numValidar > min && numValidar < max) {
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
