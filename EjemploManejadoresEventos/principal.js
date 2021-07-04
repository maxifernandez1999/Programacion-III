/// <reference path="secundaria.ts" />
var Ejemplo;
(function (Ejemplo) {
    var Principal = /** @class */ (function () {
        function Principal() {
        }
        Principal.EjecutarEstatico = function () {
            alert("Hola desde método static.");
        };
        Principal.prototype.EjecutarInstancia = function () {
            alert("Hola desde instancia del principal.");
        };
        return Principal;
    }());
    Ejemplo.Principal = Principal;
    Ejemplo.objPrincipal = new Principal();
})(Ejemplo || (Ejemplo = {}));
var obj = new OtroNamespace.Secundaria();
