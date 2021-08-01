"use strict";
/**Realizar una función que reciba un parámetro requerido de tipo numérico y otro opcional de tipo cadena. Si el segundo parámetro es recibido, se mostrará tantas veces por consola, como lo indique el primer parámetro. En caso de no recibir el segundo parámetro, se mostrará el valor inverso del primer parámetro. */
var funcion = function (numero, cadena) {
    if (cadena) {
        var i = 0;
        while (i < numero) {
            console.log(cadena);
            i++;
        }
    }
    else {
        var numeroInvertido = numero.toString().split('').reverse().join('');
        console.log(numeroInvertido);
    }
    return;
};
funcion(34);
//# sourceMappingURL=Ej03.js.map