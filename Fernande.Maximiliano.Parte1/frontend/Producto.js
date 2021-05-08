"use strict";
var Entidades;
(function (Entidades) {
    var Producto = /** @class */ (function () {
        function Producto(nombre, origen) {
            this.nombre = nombre;
            this.origen = origen;
        }
        Producto.prototype.toString = function () {
            return "{\"nombre\":" + this.nombre + ",\"correo\":" + this.origen + "}";
        };
        Producto.prototype.toJSON = function () {
            JSON.stringify(this.toString());
        };
        return Producto;
    }());
    Entidades.Producto = Producto;
})(Entidades || (Entidades = {}));
//# sourceMappingURL=Producto.js.map