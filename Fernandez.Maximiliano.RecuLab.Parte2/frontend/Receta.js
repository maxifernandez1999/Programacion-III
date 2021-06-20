"use strict";
var Entidades;
(function (Entidades) {
    var Receta = /** @class */ (function () {
        function Receta(id, nombre, ingredientes, tipo, foto) {
            this.id = id;
            this.nombre = nombre;
            this.ingredientes = ingredientes;
            this.tipo = tipo;
            this.foto = foto;
        }
        Receta.prototype.ToJson = function () {
            return JSON.stringify(this);
        };
        return Receta;
    }());
    Entidades.Receta = Receta;
})(Entidades || (Entidades = {}));
//# sourceMappingURL=Receta.js.map