"use strict";
/**Realizar una función que solicite (por medio de un parámetro) un número. Si el número es positivo, se mostrará el factorial de ese número, caso contrario se mostrará el cubo de dicho número.
Nota: Reutilizar la función que determina el factorial de un número y la que calcula el cubo de un número. */
var numero = -3;
var funcion = function (numero) {
    if (numero > 0) {
        calcularFactorial(numero);
    }
    else {
        var cubo = numeroCubo(numero);
        console.log(cubo);
    }
};
//# sourceMappingURL=Ej09.js.map