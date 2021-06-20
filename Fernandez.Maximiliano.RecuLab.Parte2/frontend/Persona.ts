namespace Entidades{
    export class Persona{
        public email:string;
        public clave:string;

        public constructor(email:string,clave:string){
            this.email = email;
            this.clave = clave;
        }

        public ToString(){
            return `{"email":${this.email},"clave":${this.clave}}`;
        }

        public ToJSON(){
            return JSON.stringify(this.ToString());
        }
    }
}