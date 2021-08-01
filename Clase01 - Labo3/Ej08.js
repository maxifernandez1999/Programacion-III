"use strict";
/**Crear una función que realice el cálculo factorial del número que recibe como parámetro.
Nota: Utilizar console.log() */
var total = 1;
function calcularFactorial(numero) {
    for (var i = numero; i > 0; i--) {
        total = total * i;
    }
    console.log(total);
}
calcularFactorial(6);
//# sourceMappingURL=Ej08.js.map