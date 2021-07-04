namespace OtroNamespace{

    export class Secundaria implements Algo{


        public Ejecutar()
        {
            alert("Hola desde método de instancia de interface.");
        }

    }

    export interface Algo{

        Ejecutar():void;
    }

}