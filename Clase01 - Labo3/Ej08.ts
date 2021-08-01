/**Crear una función que realice el cálculo factorial del número que recibe como parámetro.
Nota: Utilizar console.log() */
var total:number = 1;
function calcularFactorial(numero:number){
    for (let i = numero; i > 0; i--) {
        total = total * i;
    } 
    console.log(total);
}
calcularFactorial(6);