var OtroNamespace;
(function (OtroNamespace) {
    var Secundaria = /** @class */ (function () {
        function Secundaria() {
        }
        Secundaria.prototype.Ejecutar = function () {
            alert("Hola desde método de instancia de interface.");
        };
        return Secundaria;
    }());
    OtroNamespace.Secundaria = Secundaria;
})(OtroNamespace || (OtroNamespace = {}));
