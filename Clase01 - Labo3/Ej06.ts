/**Realizar una función que reciba como parámetro un número y que retorne el cubo delmismo.
Nota: La función retornará el cubo del parámetro ingresado. Realizar una función que invoque a esta última y permita mostrar por consola el resultado. */

var numero:number = 5;
function numeroCubo(numero:number):number{
    var cubo:number = numero * numero * numero;
    return cubo;
}
let mostrar:Function = ()=>{
    console.log(`El resultado es: ${numeroCubo(numero)}`);
}
mostrar();

