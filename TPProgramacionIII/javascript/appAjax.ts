/// <reference path="ajax.ts" />
/// <reference path="validaciones.ts" />
/// <reference path="administrarValidaciones.ts" />

namespace Main{

    let ajax : Ajax = new Ajax();
    export function Reset(){
        (<HTMLFormElement>document.getElementById('reset')).reset;
    }
    export function AltaEmpleado(){
        if(AdministrarValidaciones()){
            let nombre:string = (<HTMLInputElement>document.getElementById('Nombre')).value;
            let apellido:string = (<HTMLInputElement>document.getElementById('apellido')).value; 
            let dni:string = (<HTMLInputElement>document.getElementById('txtDni')).value; 
            let sexo:string = (<HTMLInputElement>document.getElementById('cboSexo')).value; 
            let legajo:string = (<HTMLInputElement>document.getElementById('txtLegajo')).value;
            let sueldo:string = (<HTMLInputElement>document.getElementById('txtSueldo')).value;
            let turno:NodeListOf<HTMLInputElement> = (<NodeListOf<HTMLInputElement>>document.getElementsByName('rdoTurno')); 
            for (let index = 0; index < turno.length; index++) {
                if (turno[index].checked) {
                    var turnoSeleccionado:string = turno[index].value;
                    break;
                }
            }
            let foto : HTMLInputElement = (<HTMLInputElement> document.getElementById('archivo'));
            var parametros:string = "txtNombre="+nombre+"?"+ "txtApellido="+apellido+"?"+"txtDni="+dni+"?"+"cboSexo="+sexo+"?"+"txtLegajo="+legajo+"?"+"txtSueldo="+sueldo+"?"+"rdoTurno="+turnoSeleccionado;
    
            ajax.Post("http://localhost/Programacion-III/TPProgramacionIII/administracion.php",ReponseSend,parametros,foto,true,Errores);
            

        }
        
    }
    export function EliminarEmpleado(legajo:number){
        ajax.Get("http://localhost/Programacion-III/TPProgramacionIII/eliminar.php",ResponseEliminar,"txtLegajo="+legajo,true,Errores);
        
    }
    export function ModificarEmpleado(dni:number){
        ajax.Get("http://localhost/Programacion-III/TPProgramacionIII/modificar.php",ResponseModificar,"txtDni="+dni,true,Errores);
        
    }
    export function MostrarEmpleados(){
        ajax.Get("http://localhost/Programacion-III/TPProgramacionIII/mostrar.php",ResponseShow,"",true,Errores);
    }
    function ResponseEliminar(responseText:string) : void{
        alert(responseText);
        MostrarEmpleados();
    }
    function ResponseModificar(responseText:string) : void{
        var arrayResponse:string[] = responseText.split("-");
        alert(responseText);
        (<HTMLInputElement>document.getElementById('Nombre')).value = arrayResponse[0];
        (<HTMLInputElement>document.getElementById('apellido')).value = arrayResponse[1]; 
        (<HTMLInputElement>document.getElementById('txtDni')).value = arrayResponse[2];
        (<HTMLInputElement>document.getElementById('txtDni')).readOnly = true;
        (<HTMLInputElement>document.getElementById('cboSexo')).value = arrayResponse[3]; 
        (<HTMLInputElement>document.getElementById('txtLegajo')).value = arrayResponse[4];
        (<HTMLInputElement>document.getElementById('txtLegajo')).readOnly = true;
        (<HTMLInputElement>document.getElementById('txtSueldo')).value = arrayResponse[5];
        let turno:any = (<NodeListOf<HTMLInputElement>>document.getElementsByName('rdoTurno')); 
            for (let index = 0; index < turno.length; index++) {
                if (turno[index].value == arrayResponse[6] ) {
                    turno[index].checked = true;
                    break;
                }
            }
        MostrarEmpleados();
    }
    function ReponseSend(responseText:string) : void{
        console.log(responseText);
        MostrarEmpleados();
    }
    function ResponseShow(reponseText:string) : void{
        
        (<HTMLInputElement>document.getElementById('cont-listado')).innerHTML = reponseText; 
    }
    function Errores(status:number){
        console.log(status.toString());
    }
}