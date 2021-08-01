//ARRAYS EN TYPESCRIPT
var vec = [1, true, "hola"];//por default es any

//solamente valores numericos
//var numeros : number[] = [1,2,true];
//var numeros : number = [1,2,3];

//primera forma
var numeros : number[] = [1,2,3];

//segunda forma
var otrosNumeros : Array<number> = [1,2,3];

var eliminado : number | undefined = numeros.pop(); //en este caso pop devuelve undefined, en el caso de que el array este vacio o el number que se elimino
console.log(eliminado);

numeros.push(5); //agrega un elemento al array
console.log(numeros);

//ENUMS EN TYPESCRIPT
enum Ejemplo
{
    Basico,
    Intermedio,
    Avanzado
}

console.log(Ejemplo.Basico);

var e : Ejemplo = Ejemplo.Intermedio; //variable de tipo enum
console.log(e);

//LET vs VAR
//let variable local
//var variable glabal
var foo : number = 123;
if(true) 
{ 
    var foo : number = 456; 
}
console.log(foo);

let foo2 : number = 123;
if(true) 
{ 
    let foo2 : number = 456; 
}
console.log(foo2);
