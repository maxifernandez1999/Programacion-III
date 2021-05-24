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

            (<HTMLInputElement>document.getElementById('txtDni')).readOnly = false;
            (<HTMLInputElement>document.getElementById('txtLegajo')).readOnly = false;
            //AGREGAR JSON
            var paramJson:string = "obj_json="+`{"txtNombre":"${nombre}","txtApellido":"${apellido}","txtDni":${dni},"cboSexo":"${sexo}","txtLegajo":${legajo},"txtSueldo":${sueldo},"rdoTurno":"${turnoSeleccionado}"}`;
            ajax.Post("../backend/administracion_pdo.php",ReponseSend,paramJson,foto,true,Errores);
            (<any>document.getElementById('titulo')).innerHTML = "Alta Empleado";
            

        }
        
    }
    export function EliminarEmpleado(legajo:number,id:number){
        ajax.Get("../backend/eliminar_pdo.php",ResponseEliminar,"txtLegajo="+legajo+"&"+"id="+id,true,Errores);
        
    }
    export function ModificarEmpleado(dni:number){
        ajax.Get("../backend/modificar_pdo.php",ResponseModificar,"txtDni="+dni,true,Errores);
        (<any>document.getElementById('titulo')).innerHTML = "Modificar Empleado";
        
    }
    export function MostrarEmpleados(){
        ajax.Get("../backend/mostrar_pdo.php",ResponseShow,"",true,Errores);
        
    }
    function ResponseEliminar(responseText:string) : void{
        console.log("Empleado preparado para modificar");
        MostrarEmpleados();
    }
    function ResponseModificar(responseText:string) : void{
         var objJSON:any = JSON.parse(responseText);
        console.log(responseText);
        (<HTMLInputElement>document.getElementById('Nombre')).value = objJSON.nombre;
        (<HTMLInputElement>document.getElementById('apellido')).value = objJSON.apellido;
        (<HTMLInputElement>document.getElementById('txtDni')).value = objJSON.dni;
        (<HTMLInputElement>document.getElementById('txtDni')).readOnly = true;
        (<HTMLInputElement>document.getElementById('cboSexo')).value = objJSON.sexo;
        (<HTMLInputElement>document.getElementById('txtLegajo')).value = objJSON.legajo;
        (<HTMLInputElement>document.getElementById('txtLegajo')).readOnly = true;
        (<HTMLInputElement>document.getElementById('txtSueldo')).value = objJSON.sueldo;
        let turno:any = (<NodeListOf<HTMLInputElement>>document.getElementsByName('rdoTurno')); 
            for (let index = 0; index < turno.length; index++) {
                if (turno[index].value == objJSON.turno) {
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