
// Namespace TestPrueba
// {
// Main()--> crear alumnos y mostrarlos por consola
// (en colección -> Array<Persona>)
// }

/// <reference path="./alumno.ts" />
namespace TestPrueba{
    let alumnos : Array<Prueba.Persona> = [new Prueba.Alumno("maxi",'Fernandez',19852),new Prueba.Alumno('Ricardo','Ford',10023)];

    alumnos.forEach(Mostrar);

    function Mostrar(a : Prueba.Persona):void{
        console.log(a.ToString());
    }
}