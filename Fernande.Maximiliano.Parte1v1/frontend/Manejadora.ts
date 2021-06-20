/// <reference path="Ajax.ts" />

namespace PrimerParcial{
    //var ajax : Ajax = new Ajax();
    export class Manejadora implements IParte2{ 
        
//         AgregarProductoJSON. Obtiene el nombre y el origen desde la página producto.html y se enviará (por AJAX)
// hacia “./BACKEND/AltaProductoJSON.php” que invoca al método GuardarJSON pasándole
// './BACKEND/archivos/productos.json' cómo parámetro para que agregue al producto en el archivo. Retornará un JSON que
// contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.
// Informar por consola y alert el mensaje recibido.
        public static AgregarProductoJSON(){
            var nombre:string = (<HTMLInputElement>document.getElementById("nombre")).value;
            var origen:string = (<HTMLInputElement>document.getElementById("cboOrigen")).value;
            var ajax : Ajax = new Ajax();
            var param:string = `nombre=${nombre}&origen=${origen}`;
            ajax.Post("./backend/AltaProductoJSON.php",this.Success,param,this.Fail);

        }
//         MostrarProductosJSON. Recuperará (por AJAX) todos los productos del archivo productos.json y generará un
// listado dinámico, crear una tabla HTML con cabecera (en el FRONTEND) que mostrará toda la información de
// cada uno de los productos. Invocar a “./BACKEND/ListadoProductosJSON.php”, recibe la petición (por GET) y
// retornará el listado de todos los productos en formato JSON.
// Informar por consola el mensaje recibido y mostrar el listado en la página (div id='divTabla').
        public static MostrarProductosJSON(){
            let ajax : Ajax = new Ajax();
            var json:string = "";
            ajax.Get("./backend/ListadoProductosJSON.php",
            (mensaje:string) => {
                var arrayProductosJSON:any = JSON.parse(mensaje);
                for (let index = 0; index < arrayProductosJSON.length; index++) {
                    json += "<tr><td>"+arrayProductosJSON[index].nombre+"</td><td>"+arrayProductosJSON[index].origen+"</td></tr>";
                    
                }
                (<HTMLDivElement>document.getElementById("divTabla")).innerHTML = "<table align=center><tr><th>NOMBRE</th><th>ORIGEN</th><th>ID</th><th>CODIGO</th><th>PATHFOTO</th><th>PRECIO</th></tr>"+json+"</table>";
                console.log("hola");
                

            },"",Manejadora.Fail);
        }
//         AgregarProductoSinFoto. Obtiene el código de barra, el nombre, el origen y el precio desde la página
// producto.html, y se enviará (por AJAX) hacia “./BACKEND/AgregarProductoSinFoto.php” que recibe por POST el
// parámetro producto_json (codigoBarra, nombre, origen y precio), en formato de cadena JSON. Se invocará al método Agregar.
// Se retornará un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.
// Informar por consola y alert el mensaje recibido.
        public static AgregarProductoSinFoto(){
            var nombre:string = (<HTMLInputElement>document.getElementById("nombre")).value;
            var origen:string = (<HTMLInputElement>document.getElementById("cboOrigen")).value;
            var codigoBarra:string = (<HTMLInputElement>document.getElementById("codigoBarra")).value;
            var precio:string = (<HTMLInputElement>document.getElementById("precio")).value;
            let ajax : Ajax = new Ajax();
            var param:string = `producto_json={"nombre":"${nombre}","codigoBarra":"${codigoBarra}","origen":"${origen}","precio":${precio}}`;
            ajax.Post("./backend/AgregarProductoSinFoto.php",this.Success,param,this.Fail);
        }
//         VerificarProductoJSON. Se invocará (por AJAX) a “./BACKEND/VerificarProductoJSON.php”. Se recibe por POST el
// nombre y el origen, si coinciden con algún registro del archivo JSON (VerificarProductoJSON), crear una COOKIE nombrada con el
// nombre y el origen del producto, separado con un guión bajo (limon_tucuman) que guardará la fecha actual (con horas, minutos y
// segundos) más el retorno del mensaje del método estático VerificarProductoJSON de la clase Producto.

// Retornar un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido (agregar, aquí también, el mensaje obtenido
// del método VerificarProductoJSON).
// Se mostrará (por consola y alert) lo acontecido.
        public static VerificarProductoJSON(){
            var nombre:string = (<HTMLInputElement>document.getElementById("nombre")).value;
            var origen:string = (<HTMLInputElement>document.getElementById("cboOrigen")).value;
            
            let ajax : Ajax = new Ajax();
            var params:string = `nombre=${nombre}&origen=${origen}`;
            ajax.Post("./backend/VerificarProductoJSON.php",this.Success,params,this.Fail);
        }
//         MostrarProductosEnvasados. Recuperará (por AJAX) todas los productos envasados de la base de datos,
// invocando a “./BACKEND/ListadoProductosEnvasados.php”, que recibirá el parámetro tabla con el valor 'json', para
// que retorne un array de objetos con formato JSON.
// Crear una tabla HTML con cabecera (en el FRONTEND) para mostrar la información de cada uno de los
// productos envasados. Preparar la tabla para que muestre la imagen, si es que la tiene. Todas las imagenes
// deben tener 50px por 50px de dimensiones.
// Informar por consola el mensaje recibido y mostrar el listado en la página (div id='divTabla').
        public static MostrarProductosEnvasados(){
            let ajax : Ajax = new Ajax();
            var json:string = "json";
            ajax.Post("./backend/ListadoProductosEnvasados.php",(mensaje:string) => {
                var arrayProductosJSON:any = JSON.parse(mensaje);
                for (let index = 0; index < arrayProductosJSON.length; index++) {
                    json += `<tr><td>${arrayProductosJSON[index].nombre}</td><td>${arrayProductosJSON[index].origen}</td><td>${arrayProductosJSON[index].id}</td><td>${arrayProductosJSON[index].codigoBarra}</td><td>${arrayProductosJSON[index].pathFoto}</td><td>${arrayProductosJSON[index].precio}</td></tr>`;
                    
                }
                (<HTMLDivElement>document.getElementById("divTabla")).innerHTML = "<table align=center><tr><th>NOMBRE</th><th>ORIGEN</th><th>ID</th><th>CODIGOBARRA</th><th>PATHFOTO</th><th>PRECIO</th></tr>"+json+"</table>";

            },`tabla=${json}`,this.Fail);
        }

//         MostrarInfoCookie. Se realizará una petición (por AJAX) a “./BACKEND/MostrarCookie.php” que recibe por GET
// el nombre y el origen del producto y se verificará si existe una cookie con el mismo nombre, de ser así, retornará un JSON que
// contendrá: éxito(bool) y mensaje(string), dónde se mostrará el contenido de la cookie. Caso contrario, false y el mensaje indicando lo
// acontecido.
// Informar por consola el mensaje recibido y mostrar el mensaje en la página (div id='divInfo').

        public static MostrarInfoCookie(){
            let ajax : Ajax = new Ajax();
            var nombre:string = (<HTMLInputElement>document.getElementById("nombre")).value;
            var origen:string = (<HTMLInputElement>document.getElementById("cboOrigen")).value;
            ajax.Get("./backend/MostrarCookie.php",
            (mensaje:string) => {
                var men:any = JSON.parse(mensaje);
                (<HTMLDivElement>document.getElementById("divInfo")).innerHTML = men.mensaje;
                console.log(men.mensaje);

            },`nombre=${nombre}&origen=${origen}`,this.Fail);
        
        }


       
        public static Success(mensaje:string){
            console.log(mensaje);
            alert(mensaje);
        }
        public static Fail(retorno:string){
            console.clear();
            console.log("ERROR!!!");
            console.log(retorno);
            alert(retorno);
        }

        public EliminarProducto(jsonEliminar:any){

        }
        
        public ModificarProducto(){

        }    
    }

}