/// <reference path="./Usuario.ts"/>
namespace Entidades{
    class Empleado extends Usuario{
        public sueldo:number;
        public foto:string;
        
        public constructor(nombre:string,correo:string,id:number,id_perfil:number,perfil:string,sueldo:number,foto:string){
            super(nombre,correo,id,id_perfil,perfil);
            this.sueldo = sueldo;
            this.foto = foto

        }
        public toString() {
            return `{"nombre":${super.nombre},"correo":${super.correo},"clave":${super.clave},"id":${super.id},"id_perfil":${super.id_perfil},"perfil":${super.perfil},"sueldo":${this.sueldo},"foto":${this.foto}}`;
        }
        public toJSON(cadena:string){
            JSON.stringify(cadena);
        }



    }
}