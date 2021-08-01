"use strict";
//ARRAYS EN TYPESCRIPT
var vec = [1, true, "hola"]; //por default es any
//solamente valores numericos
//var numeros : number[] = [1,2,true];
//var numeros : number = [1,2,3];
//primera forma
var numeros = [1, 2, 3];
//segunda forma
var otrosNumeros = [1, 2, 3];
var eliminado = numeros.pop(); //en este caso pop devuelve undefined, en el caso de que el array este vacio o el number que se elimino
console.log(eliminado);
numeros.push(5); //agrega un elemento al array
console.log(numeros);
//ENUMS EN TYPESCRIPT
var Ejemplo;
(function (Ejemplo) {
    Ejemplo[Ejemplo["Basico"] = 0] = "Basico";
    Ejemplo[Ejemplo["Intermedio"] = 1] = "Intermedio";
    Ejemplo[Ejemplo["Avanzado"] = 2] = "Avanzado";
})(Ejemplo || (Ejemplo = {}));
console.log(Ejemplo.Basico);
var e = Ejemplo.Intermedio; //variable de tipo enum
console.log(e);
//LET vs VAR
//let variable local
//var variable glabal
var foo = 123;
if (true) {
    var foo = 456;
}
console.log(foo);
var foo2 = 123;
if (true) {
    var foo2_1 = 456;
}
console.log(foo2);
//# sourceMappingURL=02_datos.js.map