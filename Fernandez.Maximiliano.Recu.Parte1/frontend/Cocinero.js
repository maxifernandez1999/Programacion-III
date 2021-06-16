"use strict";
var Entidades;
(function (Entidades) {
    var Cocinero = /** @class */ (function () {
        function Cocinero(especialidad, email, clave) {
            this.especialidad = especialidad;
            this.email = email;
            this.clave = clave;
        }
        Cocinero.prototype.ToString = function () {
            return "{\"especialidad\":" + this.especialidad + ",\"email\":" + this.email + ",\"clave\":" + this.clave + "}";
        };
        Cocinero.prototype.ToJSON = function () {
            return JSON.stringify(this.ToString());
        };
        return Cocinero;
    }());
    Entidades.Cocinero = Cocinero;
})(Entidades || (Entidades = {}));
//# sourceMappingURL=Cocinero.js.map