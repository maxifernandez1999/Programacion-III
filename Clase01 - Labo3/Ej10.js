"use strict";
/**Definir una función que muestre información sobre una cadena de texto que se le pasa como argumento. A partir de la cadena que se le pasa, la función determina si esa cadena está formada sólo por mayúsculas, sólo por minúsculas o por una mezcla de ambas. */
var cadenaMayusculas = 'HOLA';
var cadenaMinusculas = 'hola';
var cadenaMinMayus = 'Hola';
function analizarCadena(cadena) {
    var cantidadLetras = 0;
    for (var i = 0; i < cadena.length; i++) {
        var letra = cadena[i];
        var letraMayuscula = letra.toUpperCase();
        //var letraMinuscula:string = letra.toLowerCase();
        if (letra === letraMayuscula) {
            cantidadLetras++;
        }
    }
    if (cantidadLetras == cadena.length) {
        console.log('La cadena de caracteres contiene unicamente MAYUSCULAS');
    }
    else if (cantidadLetras == 0) {
        console.log('La cadena de caracteres contiene unicamente minusculas');
    }
    if (cantidadLetras != 0 && cantidadLetras < cadena.length) {
        console.log('La cadena de caracteres letras Mayusculas y letras Minusculas');
    }
}
analizarCadena(cadenaMayusculas);
//# sourceMappingURL=Ej10.js.map