/// <reference path="ajax.ts" />
namespace RecuperatorioPrimerParcial{
    export class Manejadora{
       public ajax:Ajax = new Ajax();

///

        public AgregarCocinero(){
            
            let especialidad:string = (<HTMLInputElement>document.getElementById("especialidad")).value;
            let email:string = (<HTMLInputElement>document.getElementById("correo")).value;
            let clave:string = (<HTMLInputElement>document.getElementById("clave")).value;
            let params:string = `especialidad=${especialidad}&email=${email}&clave=${clave}`;
            this.ajax.Post("./backend/AltaCocinero.php",this.Success,params,this.Fail);
        }
        public Success(resultado:string){
            console.log(resultado);
            alert(resultado);
        }

        public Fail(retorno:string):void {
            console.clear();
            console.log("ERROR!!!");
            console.log(retorno);
        }

///

        public MostrarCocineros(){
            this.ajax.Get("./backend/ListadoCocineros.php",(resultado:string)=>{
                let json:any = JSON.parse(resultado);
                var datosCocineros:string = "";
                var encabezado:string = `
                <tr>
                    <th>EMAIL</th>
                    <th>CLAVE</th>
                    <th>ESPECIALIDAD</th>
                </tr>`;
                for (let index = 0; index < json.length; index++) {
                    datosCocineros +=
                    `<tr>
                        <td>${json[index].email}</td>
                        <td>${json[index].clave}</td>
                        <td>${json[index].especialidad}</td>
                    </tr>`;
                }
                var tablaCocineros = "<table align=center>"+encabezado+datosCocineros+"</table>";
                (<HTMLDivElement>document.getElementById("divTabla")).innerHTML = tablaCocineros;
            },"",this.Fail);
        }

///
        public VerificarExistencia(){
            let email:string = (<HTMLInputElement>document.getElementById("correo")).value;
            let clave:string = (<HTMLInputElement>document.getElementById("clave")).value;
            let params:string = `email=${email}&clave=${clave}`;
            this.ajax.Post("./backend/VerificarCocinero.php",this.Success,params,this.Fail);
        }
//         

        public AgregarRecetaSinFoto(){
            let nombre:string = (<HTMLInputElement>document.getElementById("nombre")).value;
            let ingredientes:string = (<HTMLInputElement>document.getElementById("ingredientes")).value;
            let tipo:string = (<HTMLInputElement>document.getElementById("cboTipo")).value;
            let params:string = `nombre=${nombre}&ingredientes=${ingredientes}&tipo=${tipo}`;
            this.ajax.Post("./backend/AgregarRecetaSinFoto.php",this.Success,params,this.Fail);
        }

        //
        public MostrarRecetas(){
            this.ajax.Get("./backend/ListadoRecetas.php",(resultado:string)=>{
                console.log(resultado);
                alert(resultado);
                (<HTMLDivElement>document.getElementById("divTabla")).innerHTML = resultado;
                
            },"",this.Fail);
        }

        //
        public AgregarVerificarReceta(){
            let nombre:string = (<HTMLInputElement>document.getElementById("nombre")).value;
            let ingredientes:string = (<HTMLInputElement>document.getElementById("ingredientes")).value;
            let tipo:string = (<HTMLInputElement>document.getElementById("cboTipo")).value;
            let foto:any = (<HTMLInputElement>document.getElementById("foto"));

            let params:string = `nombre=${nombre}&ingredientes=${ingredientes}&tipo=${tipo}`;
            this.ajax.Post("./backend/AgregarReceta.php",(resultado:string)=>{
                console.log(resultado);
                alert(resultado);
                this.MostrarRecetas();
            },params,this.Fail,foto);
        }
        
        public EliminarReceta(objJSON:any){
            let obj:any = JSON.parse(objJSON); 
            let params:string = `receta_json={"id":${objJSON.id},"nombre":"${objJSON.nombre}","tipo":"${objJSON.tipo}"`;
            confirm(`${objJSON.nombre}-${objJSON.tipo}`);
            this.ajax.Post("./backend/EliminarReceta.php",this.Success,params,this.Fail);
        }
        // public ModificarReceta(objJSON:any){

        // }


    }
    export var objCocinero = new Manejadora();
}