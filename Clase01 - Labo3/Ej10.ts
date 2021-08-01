/**Definir una función que muestre información sobre una cadena de texto que se le pasa como argumento. A partir de la cadena que se le pasa, la función determina si esa cadena está formada sólo por mayúsculas, sólo por minúsculas o por una mezcla de ambas. */

var cadenaMayusculas:string = 'HOLA';
var cadenaMinusculas:string = 'hola';
var cadenaMinMayus:string = 'Hola';
function analizarCadena(cadena:string){
    var cantidadLetras:number = 0;
    for (let i = 0; i < cadena.length; i++) {
        var letra:string = cadena[i];
        var letraMayuscula:string = letra.toUpperCase();
        //var letraMinuscula:string = letra.toLowerCase();
        if (letra === letraMayuscula) {
            cantidadLetras++;
        }
    }
    if (cantidadLetras == cadena.length) {
        console.log('La cadena de caracteres contiene unicamente MAYUSCULAS');
    }else if(cantidadLetras == 0){
        console.log('La cadena de caracteres contiene unicamente minusculas');
    }
    if (cantidadLetras != 0 && cantidadLetras < cadena.length ) {
        console.log('La cadena de caracteres letras Mayusculas y letras Minusculas');
    }
}
analizarCadena(cadenaMayusculas);
