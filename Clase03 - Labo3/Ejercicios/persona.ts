// Namespace Prueba
// {
// Clase Persona (apellido; nombre; ToString():string)
// (atributos protected; propiedades públicas;)

namespace Prueba{
    export class Persona{
        protected apellido:string;
        protected nombre:string;

        public constructor(apellido:string,nombre:string){
            this.nombre = nombre;
            this.apellido = apellido;
        }
        public ToString():string {
            return this.nombre + ' ' + this.apellido;
        }
    }
} 