/**Guardar su nombre y apellido en dos variables distintas. Dichas variables serán pasadas como parámetro de la función MostrarNombreApellido, que mostrará el apellido en mayúscula y el nombre solo con la primera letra en mayúsculas y el resto en minúsculas.
El apellido y el nombre se mostrarán separados por una coma (,).
Nota: Utilizar console.log() */

var nombre:string = 'mAxImLiAnO';
var apellido:string = 'fernandeZ';
MostrarNombreApellido(nombre,apellido);

function MostrarNombreApellido(nombre:string ,apellido:string){
    var apellidoFormateado:string = apellido.toUpperCase();
    var primerLetra:string = nombre[0].toUpperCase();
    var otrasLetras:string = nombre.slice(1).toLowerCase();
    var nombreFormateado:string = primerLetra.concat(otrasLetras);
    console.log(`${apellidoFormateado}, ${nombreFormateado}`);
    
}
