namespace Entidades{
    export class Cocinero{
        public especialidad:string;
        public email:string;
        public clave:string;

        public constructor(especialidad:string,email:string,clave:string){
            this.especialidad = especialidad;
            this.email = email;
            this.clave = clave;
        }

        public ToString(){
            return `{"especialidad":${this.especialidad},"email":${this.email},"clave":${this.clave}}`;
        }

        public ToJSON(){
            return JSON.stringify(this.ToString());
        }
    }
}