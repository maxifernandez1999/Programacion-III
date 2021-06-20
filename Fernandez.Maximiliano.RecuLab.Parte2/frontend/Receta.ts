namespace Entidades{
    export class Receta{
        public id:number;
        public nombre:string;
        public ingredientes:string;
        public tipo:string;
        public foto:string;

        public constructor(id:number,nombre:string,ingredientes:string,tipo:string,foto:string){
            this.id = id;
            this.nombre = nombre;
            this.ingredientes = ingredientes;
            this.tipo = tipo;
            this.foto = foto;
        }

        public ToJson(){
            return JSON.stringify(this);
        }
    }
}