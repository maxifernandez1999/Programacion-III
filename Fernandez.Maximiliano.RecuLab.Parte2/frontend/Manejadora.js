"use strict";
/// <reference path="ajax.ts" />
var RecuperatorioPrimerParcial;
(function (RecuperatorioPrimerParcial) {
    var Manejadora = /** @class */ (function () {
        function Manejadora() {
            this.ajax = new Ajax();
            // public ModificarReceta(objJSON:any){
            // }
        }
        ///
        Manejadora.prototype.AgregarCocinero = function () {
            var especialidad = document.getElementById("especialidad").value;
            var email = document.getElementById("correo").value;
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
        ///
        Manejadora.prototype.MostrarCocineros = function () {
            this.ajax.Get("./backend/ListadoCocineros.php", function (resultado) {
                var json = JSON.parse(resultado);
                var datosCocineros = "";
                var encabezado = "\n                <tr>\n                    <th>EMAIL</th>\n                    <th>CLAVE</th>\n                    <th>ESPECIALIDAD</th>\n                </tr>";
                for (var index = 0; index < json.length; index++) {
                    datosCocineros +=
                        "<tr>\n                        <td>" + json[index].email + "</td>\n                        <td>" + json[index].clave + "</td>\n                        <td>" + json[index].especialidad + "</td>\n                    </tr>";
                }
                var tablaCocineros = "<table align=center>" + encabezado + datosCocineros + "</table>";
                document.getElementById("divTabla").innerHTML = tablaCocineros;
            }, "", this.Fail);
        };
        ///
        Manejadora.prototype.VerificarExistencia = function () {
            var email = document.getElementById("correo").value;
            var clave = document.getElementById("clave").value;
            var params = "email=" + email + "&clave=" + clave;
            this.ajax.Post("./backend/VerificarCocinero.php", this.Success, params, this.Fail);
        };
        //         
        Manejadora.prototype.AgregarRecetaSinFoto = function () {
            var nombre = document.getElementById("nombre").value;
            var ingredientes = document.getElementById("ingredientes").value;
            var tipo = document.getElementById("cboTipo").value;
            var params = "nombre=" + nombre + "&ingredientes=" + ingredientes + "&tipo=" + tipo;
            this.ajax.Post("./backend/AgregarRecetaSinFoto.php", this.Success, params, this.Fail);
        };
        //
        Manejadora.prototype.MostrarRecetas = function () {
            this.ajax.Get("./backend/ListadoRecetas.php", function (resultado) {
                console.log(resultado);
                alert(resultado);
                document.getElementById("divTabla").innerHTML = resultado;
            }, "", this.Fail);
        };
        //
        Manejadora.prototype.AgregarVerificarReceta = function () {
            var _this = this;
            var nombre = document.getElementById("nombre").value;
            var ingredientes = document.getElementById("ingredientes").value;
            var tipo = document.getElementById("cboTipo").value;
            var foto = document.getElementById("foto");
            var params = "nombre=" + nombre + "&ingredientes=" + ingredientes + "&tipo=" + tipo;
            this.ajax.Post("./backend/AgregarReceta.php", function (resultado) {
                console.log(resultado);
                alert(resultado);
                _this.MostrarRecetas();
            }, params, this.Fail, foto);
        };
        Manejadora.prototype.EliminarReceta = function (objJSON) {
            var obj = JSON.parse(objJSON);
            var params = "receta_json={\"id\":" + objJSON.id + ",\"nombre\":\"" + objJSON.nombre + "\",\"tipo\":\"" + objJSON.tipo + "\"";
            confirm(objJSON.nombre + "-" + objJSON.tipo);
            this.ajax.Post("./backend/EliminarReceta.php", this.Success, params, this.Fail);
        };
        return Manejadora;
    }());
    RecuperatorioPrimerParcial.Manejadora = Manejadora;
    RecuperatorioPrimerParcial.objCocinero = new Manejadora();
})(RecuperatorioPrimerParcial || (RecuperatorioPrimerParcial = {}));
//# sourceMappingURL=Manejadora.js.map