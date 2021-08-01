/**Cree una aplicación que muestre, a través de un Array, los nombres de los meses de un año y el número al que ese mes corresponde. Utilizar una estructura repetitiva para escribir en la consola (console.log()). */
var vec:string[] = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

var u:number = 1;
for (let i = 0; i < 12; i++) {
    console.log(`numero del mes: ${u}. Nombre del mes: ${vec[i]}`);
    u++;

}