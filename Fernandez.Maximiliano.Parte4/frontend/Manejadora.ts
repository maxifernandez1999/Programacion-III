/// <reference path="Ajax.ts" />
namespace ModeloParcial{
    class Manejadora{ //static
        public AgregarUsuarioJSON(){
            var nombre:string = (<HTMLInputElement>document.getElementById("nombre")).value;
            var correo:string = (<HTMLInputElement>document.getElementById("correo")).value;
            var clave:string = (<HTMLInputElement>document.getElementById("clave")).value;
            let ajax : Ajax = new Ajax();
            var param:string = `nombre=${nombre}&correo=${correo}&clave=${clave}`;
            ajax.Post("./backend/AltaUsuarioJSON.php",this.Success,param,this.Fail,null);

        }
        
        public MostrarUsuariosJSON(){
            let ajax : Ajax = new Ajax();
            ajax.Get("./backend/AltaUsuarioJSON.php",
            (mensaje:string) => {
                var arrayUsuariosJSON:any = JSON.parse(mensaje);
                for (let index = 0; index < arrayUsuariosJSON.length; index++) {
                    var json:string = `<tr><td>${arrayUsuariosJSON[index].id}</td><td>${arrayUsuariosJSON[index].nombre}</td><td>${arrayUsuariosJSON[index].correo}</td><td>${arrayUsuariosJSON[index].clave}</td><td>${arrayUsuariosJSON[index].id_perfil}</td><td>${arrayUsuariosJSON[index].perfil}</td></tr>`;
                    
                }
                (<HTMLDivElement>document.getElementById("divTabla")).innerHTML = "<table align=center><tr><th>ID</th><th>NOMBRE</th><th>CORREO</th><th>CLAVE</th><th>ID_PERFIL</th><th>PERFIL</th></tr>"+json+"</table>";

            },null,this.Fail);
        }
        // AgregarUsuario. Obtiene el nombre, el correo, la clave y el id_perfil desde la página usuario.html y se enviará 
        // (por AJAX) hacia “./BACKEND/AltaUsuario.php” que recibe por POST el nombre, el correo, la clave e id_perfil. Se invocará 
        // al método Agregar. 
        // Se retornará un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.
        // Informar por consola y alert el mensaje recibido.
        public AgregarUsuario(){
            var nombre:string = (<HTMLInputElement>document.getElementById("nombre")).value;
            var correo:string = (<HTMLInputElement>document.getElementById("correo")).value;
            var clave:string = (<HTMLInputElement>document.getElementById("clave")).value;
            var id_perfil:string = (<HTMLInputElement>document.getElementById("cboPerfiles")).value;
            let ajax : Ajax = new Ajax();
            var params:string = `nombre=${nombre}&correo=${correo}&clave=${clave}&id_perfil=${id_perfil}`;
            ajax.Post("./backend/AltaUsuario.php",this.Success,null,this.Fail,null);
        }
        // VerificarUsuario. Verifica que el usuario exista. Para ello, invocará (por AJAX) a 
        // “./BACKEND/VerificarUsuario.php”. Se recibe por POST parámetro usuario_json (correo y clave, en formato de cadena 
        // JSON).Retornar un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido (agregar el mensaje obtenido del método de 
        // clase).
        // Se mostrará (por consola y alert) lo acontecido. 
        public VerificarUsuario(){
            var correo:string = (<HTMLInputElement>document.getElementById("correo")).value;
            var clave:string = (<HTMLInputElement>document.getElementById("clave")).value;
            //var id_perfil:string = (<HTMLInputElement>document.getElementById("cboPerfiles")).value;
            let ajax : Ajax = new Ajax();
            var params:string = `obj_json={"correo":${correo},"clave":${clave}}`;
            ajax.Post("./backend/VerificarUsuario.php",this.Success,params,this.Fail);
        }
//         Armar la tabla en el frontend y mostrar el listado en la página (div id='divTabla').
// NOTA: Agregar una columna (Acciones) al listado de usuarios que permita: Eliminar y Modificar al usuario 
// elegido. Para ello, agregue dos botones (input [type=button]) que invoquen a las funciones EliminarUsuario y 
// ModificarUsuario, respectivamente
        public MostrarUsuarios(){
            let ajax : Ajax = new Ajax();
            ajax.Post("./backend/ListadoUsuarios.php",(mensaje:string) => {
                (<HTMLDivElement>document.getElementById("divTabla")).innerHTML = mensaje;

            },"tabla=mostrar",this.Fail,null);
        }

        public ModificarUsuario(objJSON : string){//se arma en el listado
            var obj:any = JSON.parse(objJSON);
            (<HTMLInputElement>document.getElementById("id")).readOnly = true;
            (<HTMLInputElement>document.getElementById("correo")).value = obj.correo;
            (<HTMLInputElement>document.getElementById("nombre")).value = obj.nombre;
            (<HTMLInputElement>document.getElementById("clave")).value = obj.clave;
            (<HTMLInputElement>document.getElementById("cboPerfiles")).value = obj.perfil;
        }
        public Modificar(){
            var id:string = (<HTMLInputElement>document.getElementById("id")).value;
            var correo:string = (<HTMLInputElement>document.getElementById("correo")).value;
            var clave:string = (<HTMLInputElement>document.getElementById("clave")).value;
            var nombre:string = (<HTMLInputElement>document.getElementById("nombre")).value;
            var id_perfil:string = (<HTMLInputElement>document.getElementById("cboPerfiles")).value;

            var json:string = `{"id":${id},"nombre":${nombre},"correo":${correo},"clave":${clave},"id_perfil":${id_perfil}}`;

            let ajax : Ajax = new Ajax();
            ajax.Post("./backend/ModificarUsuario.php",(mensaje:string) => {
                var json:any = JSON.parse(mensaje);
                if(json.exito == true){
                    this.MostrarUsuarios();
                }else{
                    alert("No se encuentra el usuario en la bd");
                    console.log("No se encuentra el usuario en la bd");
                }

            },`usuario_json=${json}`,this.Fail,null);
        }
        public Success(mensaje:string){
            console.log(mensaje);
            alert(mensaje);
        }
        public Fail(retorno:string){
            console.clear();
            console.log("ERROR!!!");
            console.log(retorno);
            alert(retorno);
        }
    }

}