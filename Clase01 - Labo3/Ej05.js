"use strict";
/**Guardar su nombre y apellido en dos variables distintas. Dichas variables serán pasadas como parámetro de la función MostrarNombreApellido, que mostrará el apellido en mayúscula y el nombre solo con la primera letra en mayúsculas y el resto en minúsculas.
El apellido y el nombre se mostrarán separados por una coma (,).
Nota: Utilizar console.log() */
var nombre = 'mAxImLiAnO';
var apellido = 'fernandeZ';
MostrarNombreApellido(nombre, apellido);
function MostrarNombreApellido(nombre, apellido) {
    var apellidoFormateado = apellido.toUpperCase();
    var primerLetra = nombre[0].toUpperCase();
    var otrasLetras = nombre.slice(1).toLowerCase();
    var nombreFormateado = primerLetra.concat(otrasLetras);
    console.log(apellidoFormateado + ", " + nombreFormateado);
}
//# sourceMappingURL=Ej05.js.map