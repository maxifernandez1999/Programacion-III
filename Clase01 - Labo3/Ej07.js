"use strict";
/**Se necesita mostrar por consola los primeros 20 números primos. Para ello realizar una función.
Nota: Utilizar console.log() */
var limite = 20;
var valor = true;
var numero = 4;
function numerosPrimos(numeroParametro) {
    for (var j = 2; j < numeroParametro; j++) {
        if (numeroParametro % j == 0) {
            valor = false;
            break;
        }
    }
    if (valor == true) {
        console.log(numeroParametro);
    }
}
//numerosPrimos(numero);
for (var i = 2; i < limite; i++) {
    numerosPrimos(i);
}
//# sourceMappingURL=Ej07.js.map