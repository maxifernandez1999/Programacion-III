"use strict";
/// <reference path="ajax.ts" />
var RecuperatorioPrimerParcial;
(function (RecuperatorioPrimerParcial) {
    var Manejadora = /** @class */ (function () {
        function Manejadora() {
            this.ajax = new Ajax();
        }
        //         AgregarProductoJSON. Obtiene el nombre y el origen desde la página producto.html y se enviará (por AJAX) 
        // hacia “./BACKEND/AltaProductoJSON.php” que invoca al método GuardarJSON pasándole 
        // './BACKEND/archivos/productos.json' cómo parámetro para que agregue al producto en el archivo. Retornará un JSON que 
        // contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.
        // Informar por consola y alert el mensaje recibido.
        Manejadora.prototype.AltaCocinero = function () {
            var especialidad = document.getElementById("especialidad").value;
            var email = document.getElementById("email").value;
            var clave = document.getElementById("clave").value;
            var params = "especialidad=" + especialidad + "&email=" + email + "&clave=" + clave;
            this.ajax.Post("./backend/AltaCocinero.php", this.Success, params, this.Fail);
        };
        Manejadora.prototype.Success = function (resultado) {
            console.log(resultado);
            alert(resultado);
        };
        Manejadora.prototype.Fail = function (retorno) {
            console.clear();
            console.log("ERROR!!!");
            console.log(retorno);
        };
        //         MostrarProductosJSON. Recuperará (por AJAX) todos los productos del archivo productos.json y generará un 
        // listado dinámico, crear una tabla HTML con cabecera (en el FRONTEND) que mostrará toda la información de 
        // cada uno de los productos. Invocar a “./BACKEND/ListadoProductosJSON.php”, recibe la petición (por GET) y 
        // retornará el listado de todos los productos en formato JSON.
        // Informar por consola el mensaje recibido y mostrar el listado en la página (div id='divTabla').
        Manejadora.prototype.MostrarCocinerosJSON = function () {
            this.ajax.Get("./backend/ListadoCocineros.php", function (resultado) {
                var json = JSON.parse(resultado);
                // let tablaRecetas:string = `<table align=center>
                //                     <tr>
                //                         <th>ID</th>
                //                         <th>NOMBRE</th>
                //                         <th>INGREDIENTES</th>
                //                         <th>TIPO</th>
                //                         <th>FOTO</th>
                //                     </tr>
                //                     <tr>
                //                         <td>$obj->id</td>
                //                         <td>$obj->nombre</td>
                //                         <td>$obj->ingredientes</td>
                //                         <td>$obj->tipo</td>
                //                         <td><img src='$obj->pathFoto' width='50px' height='50px'></td>
                //                     </tr>`;
                var datosCocineros = "";
                var encabezado = "\n                <tr>\n                    <th>ESPECIALIDAD</th>\n                    <th>EMAIL</th>\n                    <th>CLAVE</th>\n                </tr>";
                for (var index = 0; index < json.length; index++) {
                    datosCocineros +=
                        "<tr>\n                        <td>" + json[index].especialidad + "</td>\n                        <td>" + json[index].email + "</td>\n                        <td>" + json[index].clave + "</td>\n                    </tr>";
                }
                var tablaCocineros = "<table align=center>" + encabezado + datosCocineros + "</table>";
                document.getElementById("divTabla").innerHTML = tablaCocineros;
            }, "", this.Fail);
        };
        //         VerificarProductoJSON. Se invocará (por AJAX) a “./BACKEND/VerificarProductoJSON.php”. Se recibe por POST el
        // nombre y el origen, si coinciden con algún registro del archivo JSON (VerificarProductoJSON), crear una COOKIE nombrada con el 
        // nombre y el origen del producto, separado con un guión bajo (limon_tucuman) que guardará la fecha actual (con horas, minutos y 
        // segundos) más el retorno del mensaje del método estático VerificarProductoJSON de la clase Producto. 
        Manejadora.prototype.VerificarCocinero = function () {
            var email = document.getElementById("email").value;
            var clave = document.getElementById("clave").value;
            var params = "email=" + email + "&clave=" + clave;
            this.ajax.Post("./backend/VerificarCocinero.php", this.Success, params, this.Fail);
        };
        //         MostrarInfoCookie. Se realizará una petición (por AJAX) a “./BACKEND/MostrarCookie.php” que recibe por GET 
        // el nombre y el origen del producto y se verificará si existe una cookie con el mismo nombre, de ser así, retornará un JSON que 
        // contendrá: éxito(bool) y mensaje(string), dónde se mostrará el contenido de la cookie. Caso contrario, false y el mensaje indicando lo 
        // acontecido.
        // Informar por consola el mensaje recibido y mostrar el mensaje en la página (div id='divInfo').
        Manejadora.prototype.MostrarInfoCookie = function () {
            var especialidad = document.getElementById("especialidad").value;
            var email = document.getElementById("email").value;
            this.ajax.Get("./backend/MostrarCookie.php", function (resultado) {
                var json = JSON.parse(resultado);
                console.log(json.mensaje);
                //(<HTMLDivElement>document.getElementById("divInfo")).innerHTML = json[0].mensaje;
            }, "especialidad=" + especialidad + "&email=" + email, this.Fail);
        };
        //         AgregarProductoSinFoto. Obtiene el código de barra, el nombre, el origen y el precio desde la página 
        // producto.html, y se enviará (por AJAX) hacia “./BACKEND/AgregarProductoSinFoto.php” que recibe por POST el 
        // parámetro producto_json (codigoBarra, nombre, origen y precio), en formato de cadena JSON. Se invocará al método Agregar. 
        // Se retornará un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.
        // Informar por consola y alert el mensaje recibido.
        Manejadora.prototype.AgregarRecetaSinFoto = function () {
            var nombre = document.getElementById("nombre").value;
            var ingredientes = document.getElementById("ingredientes").value;
            var tipo = document.getElementById("tipo").value;
            var params = "nombre=" + nombre + "&ingredientes=" + ingredientes + "&tipo=" + tipo;
            this.ajax.Post("./backend/AgregarRecetaSinFoto.php", this.Success, params, this.Fail);
        };
        //         MostrarProductosEnvasados. Recuperará (por AJAX) todas los productos envasados de la base de datos, 
        // invocando a “./BACKEND/ListadoProductosEnvasados.php”, que recibirá el parámetro tabla con el valor 'json', para 
        // que retorne un array de objetos con formato JSON.
        // Crear una tabla HTML con cabecera (en el FRONTEND) para mostrar la información de cada uno de los 
        // productos envasados. Preparar la tabla para que muestre la imagen, si es que la tiene. Todas las imagenes 
        // deben tener 50px por 50px de dimensiones.
        // Informar por consola el mensaje recibido y mostrar el listado en la página (div id='divTabla').
        Manejadora.prototype.ListadoRecetas = function () {
            this.ajax.Get("./backend/ListadoRecetas.php", function (resultado) {
                document.getElementById("divTabla").innerHTML = resultado;
            }, "", this.Fail);
        };
        return Manejadora;
    }());
    RecuperatorioPrimerParcial.Manejadora = Manejadora;
    RecuperatorioPrimerParcial.objCocinero = new Manejadora();
})(RecuperatorioPrimerParcial || (RecuperatorioPrimerParcial = {}));
//# sourceMappingURL=Manejadora.js.map