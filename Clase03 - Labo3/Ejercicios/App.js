var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        if (typeof b !== "function" && b !== null)
            throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
// Namespace Prueba
// {
// Clase Persona (apellido; nombre; ToString():string)
// (atributos protected; propiedades públicas;)
var Prueba;
(function (Prueba) {
    var Persona = /** @class */ (function () {
        function Persona(apellido, nombre) {
            this.nombre = nombre;
            this.apellido = apellido;
        }
        Persona.prototype.ToString = function () {
            return this.nombre + ' ' + this.apellido;
        };
        return Persona;
    }());
    Prueba.Persona = Persona;
})(Prueba || (Prueba = {}));
// Clase Alumno (legajo; ToString():string)
// (atributo protected; propiedad pública;)
// }
/// <reference path="./persona.ts" />
var Prueba;
(function (Prueba) {
    var Alumno = /** @class */ (function (_super) {
        __extends(Alumno, _super);
        function Alumno(nombre, apellido, legajo) {
            var _this = _super.call(this, apellido, nombre) || this;
            _this.legajo = legajo;
            return _this;
        }
        Object.defineProperty(Alumno.prototype, "Legajo", {
            get: function () {
                return this.legajo;
            },
            set: function (value) {
                this.legajo = value;
            },
            enumerable: false,
            configurable: true
        });
        Alumno.prototype.ToString = function () {
            return _super.prototype.ToString.call(this) + this.legajo;
        };
        return Alumno;
    }(Prueba.Persona));
    Prueba.Alumno = Alumno;
})(Prueba || (Prueba = {}));
// Namespace TestPrueba
// {
// Main()--> crear alumnos y mostrarlos por consola
// (en colección -> Array<Persona>)
// }
/// <reference path="./alumno.ts" />
var TestPrueba;
(function (TestPrueba) {
    var alumnos = [new Prueba.Alumno("maxi", 'Fernandez', 19852), new Prueba.Alumno('Ricardo', 'Ford', 10023)];
    alumnos.forEach(Mostrar);
    function Mostrar(a) {
        console.log(a.ToString());
    }
})(TestPrueba || (TestPrueba = {}));
