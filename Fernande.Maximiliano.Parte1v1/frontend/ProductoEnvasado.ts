/// <reference path="./Producto.ts"/>
namespace Entidades{
    export class ProductoEnvasado extends Producto{
        public id:number|undefined;
        public codigoBarra:string|undefined;
        public precio:number|undefined;
        public pathFoto:string|undefined;
        

        public constructor(nombre:string, origen:string,id?:number,codigoBarra?:string,precio?:number,pathFoto?:string){
            super(nombre,origen);
            this.id = id;
            this.codigoBarra = codigoBarra;
            this.pathFoto = pathFoto;
            this.precio = precio;

        }
        public toString() {
            return `{"nombre":${this.nombre},"correo":${this.origen},"id":${this.id},"codigoBarra":${this.codigoBarra},"pathFoto":${this.pathFoto},"precio":${this.precio}}`;
        }
        public toJSON(){
            JSON.stringify(this.toString());
        }



    }
}