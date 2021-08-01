"use strict";
/**Realizar una función que reciba como parámetro un número y que retorne el cubo delmismo.
Nota: La función retornará el cubo del parámetro ingresado. Realizar una función que invoque a esta última y permita mostrar por consola el resultado. */
var numero = 5;
function numeroCubo(numero) {
    var cubo = numero * numero * numero;
    return cubo;
}
var mostrar = function () {
    console.log("El resultado es: " + numeroCubo(numero));
};
mostrar();
//# sourceMappingURL=Ej06.js.map