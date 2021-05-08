namespace Entidades{
    export class Producto{
        public nombre:string;
        public origen:string;

        public constructor(nombre:string,origen:string){
            this.nombre = nombre;
            this.origen = origen;
        }
        public toString():string {
            return `{"nombre":${this.nombre},"correo":${this.origen}}`;
        }
        public toJSON(){
            JSON.stringify(this.toString());
        }


    }
}