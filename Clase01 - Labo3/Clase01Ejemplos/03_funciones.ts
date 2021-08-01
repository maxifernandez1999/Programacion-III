//FUNCIONES BASICAS
function Sumar(a:number, b:number):number {
    return a+b;
}

function Saludar(nombre:string):string {
    return "Hola " + nombre;
}

function Despedir():void {
    console.log("Chau!");
}
//************************************************************************************************/
//FUNCIONES COMO VARIABLES
let miFuncion : Function = Sumar; //se puede guardar una funcion en una variable

console.log(miFuncion(5, 5));//se llama a la variable y se pasan los parametros

//miFuncion = Saludar;

//console.log(miFuncion("Juan"));


//FUNCIONES ANONIMAS 
//son funciones sin nombres guardadas en una variable
let miVariable : Function = function(): void {
                    console.log("hola");
                }
miVariable();//se llama a la variable que almacena la funcion anonima

let varDespedir : void = Despedir();
//console.log(varDespedir())

let miOtraFuncion : Function = Saludar;
console.log(miOtraFuncion("Juan"));
//************************************************************************************************/

//************************************************************************************************/
//PARAMETROS OPCIONALES
//En JavaScript todos los parametros son opcionales ver el ejemplo en el navegador

//? significa que el parametro es opcional
//todos los parametros opcionales tienen que ir juntos
function NombreApellido(nombre:string, apellido?:string ):string {

    if(apellido){//si le paso el apellido entra al if
        return nombre + ' ' + apellido;
    }
    else{
        return nombre;
    }
}

let nombre : string = NombreApellido("Juan", "Perez");
let otroNombre : string = NombreApellido("Juan");

console.log(nombre);
console.log(otroNombre);
//************************************************************************************************/

//************************************************************************************************/
//PARAMETROS PREDETERMINADOS
//por parametro ya esta definido algun valor
function GenerarNombreCompleto(nombre: string, apellido: string, capitalizado: boolean = false):string {

    var cadena: string;
    if (capitalizado)
        cadena = Capitalizar(nombre) + " " + Capitalizar(apellido);
    else
        cadena = nombre + ' ' + apellido;
    return cadena;
}

function Capitalizar(cadena: string):string {

    return cadena.charAt(0).toUpperCase() + cadena.slice(1).toLowerCase();
}

 console.log(GenerarNombreCompleto("tony", "stark", true));
//************************************************************************************************/

//************************************************************************************************/
//PARAMETROS REST
//solo se les puede pasar array de algun tipo
function CompletarNombreApellido( nombre:string, ...losDemasParametros:string[] ):string {
	return nombre + " " + losDemasParametros.join(" ");//convierte un array en una cadena de caracteres con delimitador
}

let superman:string = CompletarNombreApellido("Clark", "Joseph", "Kent");
let ironman:string = CompletarNombreApellido("Anthony", "Edward", "Tony", "Stark");

console.log(superman);
console.log(ironman);
//************************************************************************************************/

//************************************************************************************************/
//SOBRECARGAS
function Sobrecargar(a:string):void;
function Sobrecargar(a:number):void;
function Sobrecargar(a:boolean):void;
function Sobrecargar(a: any):void {
    console.log(typeof(a));
}

Sobrecargar("cadena");
Sobrecargar(123);
Sobrecargar(true);