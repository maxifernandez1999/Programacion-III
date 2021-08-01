/**Realizar una función que reciba un parámetro requerido de tipo numérico y otro opcional de tipo cadena. Si el segundo parámetro es recibido, se mostrará tantas veces por consola, como lo indique el primer parámetro. En caso de no recibir el segundo parámetro, se mostrará el valor inverso del primer parámetro. */

var funcion: Function = function(numero:number, cadena?:string | number){
    if (cadena) {
        var i:number = 0;
        while (i < numero) {
            console.log(cadena);
            i++;
        }
    }else{
        var numeroInvertido:string = numero.toString().split('').reverse().join('');
        console.log(numeroInvertido);
    }
    return 
}
funcion(34);