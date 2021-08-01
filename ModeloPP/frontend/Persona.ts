namespace Entidades{
    export class Persona{
        public nombre:string;
        public correo:string;
        public clave:string;

        public constructor(nombre:string,correo:string){
            this.nombre = nombre;
            this.correo = correo;
        }
        public toString():string {
            return `{"nombre":${this.nombre},"correo":${this.correo},"clave":${this.clave}}`;
        }
        public toJSON(cadena:string){
            JSON.stringify(cadena);
        }


    }
}