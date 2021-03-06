"use strict";
//FUNCIONES BASICAS
function Sumar(a, b) {
    return a + b;
}
function Saludar(nombre) {
    return "Hola " + nombre;
}
function Despedir() {
    console.log("Chau!");
}
//************************************************************************************************/
//FUNCIONES COMO VARIABLES
var miFuncion = Sumar; //se puede guardar una funcion en una variable
console.log(miFuncion(5, 5)); //se llama a la variable y se pasan los parametros
//miFuncion = Saludar;
//console.log(miFuncion("Juan"));
//FUNCIONES ANONIMAS 
//son funciones sin nombres guardadas en una variable
var miVariable = function () {
    console.log("hola");
};
miVariable(); //se llama a la variable que almacena la funcion anonima
var varDespedir = Despedir();
//console.log(varDespedir())
var miOtraFuncion = Saludar;
console.log(miOtraFuncion("Juan"));
//************************************************************************************************/
//************************************************************************************************/
//PARAMETROS OPCIONALES
//En JavaScript todos los parametros son opcionales ver el ejemplo en el navegador
//? significa que el parametro es opcional
//todos los parametros opcionales tienen que ir juntos
function NombreApellido(nombre, apellido) {
    if (apellido) { //si le paso el apellido entra al if
        return nombre + ' ' + apellido;
    }
    else {
        return nombre;
    }
}
var nombre = NombreApellido("Juan", "Perez");
var otroNombre = NombreApellido("Juan");
console.log(nombre);
console.log(otroNombre);
//************************************************************************************************/
//************************************************************************************************/
//PARAMETROS PREDETERMINADOS
//por parametro ya esta definido algun valor
function GenerarNombreCompleto(nombre, apellido, capitalizado) {
    if (capitalizado === void 0) { capitalizado = false; }
    var cadena;
    if (capitalizado)
        cadena = Capitalizar(nombre) + " " + Capitalizar(apellido);
    else
        cadena = nombre + ' ' + apellido;
    return cadena;
}
function Capitalizar(cadena) {
    return cadena.charAt(0).toUpperCase() + cadena.slice(1).toLowerCase();
}
console.log(GenerarNombreCompleto("tony", "stark", true));
//************************************************************************************************/
//************************************************************************************************/
//PARAMETROS REST
//solo se les puede pasar array de algun tipo
function CompletarNombreApellido(nombre) {
    var losDemasParametros = [];
    for (var _i = 1; _i < arguments.length; _i++) {
        losDemasParametros[_i - 1] = arguments[_i];
    }
    return nombre + " " + losDemasParametros.join(" "); //convierte un array en una cadena de caracteres con delimitador
}
var superman = CompletarNombreApellido("Clark", "Joseph", "Kent");
var ironman = CompletarNombreApellido("Anthony", "Edward", "Tony", "Stark");
console.log(superman);
console.log(ironman);
function Sobrecargar(a) {
    console.log(typeof (a));
}
Sobrecargar("cadena");
Sobrecargar(123);
Sobrecargar(true);
//# sourceMappingURL=03_funciones.js.map