/**Se necesita mostrar por consola los primeros 20 números primos. Para ello realizar una función.
Nota: Utilizar console.log() */
var limite:number = 20;
var valor:boolean = true;
var numero:number = 4;
function numerosPrimos(numeroParametro:number){
    for (var  j = 2; j < numeroParametro; j++) {   
        if(numeroParametro % j == 0){
            valor = false;
            break;
        }    
    }
    if (valor == true) {
        console.log(numeroParametro);
    }    
}
//numerosPrimos(numero);

for (let i = 2; i < limite; i++) {
    numerosPrimos(i);
    
}

