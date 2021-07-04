/// <reference path="secundaria.ts" />

namespace Ejemplo{

    export class Principal{

        public static EjecutarEstatico(): void {

            alert("Hola desde método static.");

        }

        public EjecutarInstancia() : void {
            
            alert("Hola desde instancia del principal.")
        }
    }


    export var objPrincipal = new Principal();

}

var obj = new OtroNamespace.Secundaria();
