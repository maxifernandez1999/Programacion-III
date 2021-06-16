namespace Entidades{
    export class Receta{
        public id:number;
        public nombre:string;
        public ingredientes:string;
        public tipo:string;
        public pathFoto:string;

        public constructor(id:number,nombre:string,ingredientes:string,tipo:string,pathFoto:string){
            this.id = id;
            this.nombre = nombre;
            this.ingredientes = ingredientes;
            this.tipo = tipo;
            this.pathFoto = pathFoto;
        }

        public ToJson(){
            return JSON.stringify(this);
        }
    }
}