/**Realizar una función que solicite (por medio de un parámetro) un número. Si el número es positivo, se mostrará el factorial de ese número, caso contrario se mostrará el cubo de dicho número.
Nota: Reutilizar la función que determina el factorial de un número y la que calcula el cubo de un número. */
var numero:number = -3;

var funcion: Function = (numero:number)=>{
    if (numero > 0) {
        calcularFactorial(numero);
    }else{
        var cubo:number = numeroCubo(numero);
        console.log(cubo);
    }
    
}
