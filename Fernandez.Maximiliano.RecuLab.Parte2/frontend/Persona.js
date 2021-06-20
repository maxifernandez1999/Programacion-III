"use strict";
var Entidades;
(function (Entidades) {
    var Persona = /** @class */ (function () {
        function Persona(email, clave) {
            this.email = email;
            this.clave = clave;
        }
        Persona.prototype.ToString = function () {
            return "{\"email\":" + this.email + ",\"clave\":" + this.clave + "}";
        };
        Persona.prototype.ToJSON = function () {
            return JSON.stringify(this.ToString());
        };
        return Persona;
    }());
    Entidades.Persona = Persona;
})(Entidades || (Entidades = {}));
//# sourceMappingURL=Persona.js.map