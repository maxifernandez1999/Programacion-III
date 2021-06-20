/// <reference path="Persona.ts" />
namespace Entidades {
    export class Cocinero extends Persona{
        public especialidad:string;
        

        public constructor(email:string,clave:string,especialidad:string){
            super(email,clave);
            this.especialidad = especialidad;
        }

        // public ToString(){
        //     return `{"especialidad":${this.especialidad},"email":${this.email},"clave":${this.clave}}`;
        // }

        public ToJSON(){
            return JSON.stringify(super.ToString());
        }
    }
}