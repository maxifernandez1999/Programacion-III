/// <reference path="../node_modules/@types/jquery/index.d.ts" />
$(function() {
    $("#btnUsuarios").on("click",Manager.Principal.MostrarUsuarios);
    $("#btnAutos").on("click",Manager.Principal.MostrarAutos);
    $("#logout").on("click",Manager.Principal.Logout); 
});
namespace Manager{
    export class Principal{
        public static Logout():void 
        {   
            localStorage.removeItem("token");

            $(location).attr('href',APIREST + "front-end");
           
        }
        public static VerificarToken(){
            let token:any = localStorage.getItem("token");
            $.ajax({
                type: 'GET',
                url: APIREST + "login", 
                dataType: "json",
                data: {}, //si es vacio {}
                headers : {"token":token,"content-type":"application/json"},
                async: true
        
            })
            .done(function (resultado:any) {
                console.log(resultado);
                if(resultado.status == 403){
                    $(location).attr('href',APIREST + "front-end");
                } 
            })
            .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });
        }
        public static MostrarUsuarios():void {
            Principal.VerificarToken();
            $.ajax({
                type: 'GET',
                url: APIREST, 
                dataType: "json",
                data: {}, //si es vacio {}
                async: true
        
            })
            .done(function (resultado:any) {
                console.log(resultado);
                if(resultado.exito == false || resultado.exito == undefined){
                    var alert:string = ArmarAlert(resultado.mensaje,"danger");
                    $('#danger').html(alert);
                }else{
                    console.log(resultado.dato);
                    var datos = JSON.parse(resultado.dato);
                    $('#tableUser').html(Principal.CrearListadoUsuarios(datos));
                }
                
            })
            .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });    
        
        }

        public static CrearListadoUsuarios(datos:any){
            let cabecera:string = `
            <tr>
                <th>Id</th>
                <th>Correo</th>
                <th>Clave</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Perfil</th>
                <th>Foto</th>
            </tr>`;
            let datoUsuario:string = "";
            for (const datoUser of datos) {
                datoUsuario += 
                `<tr>
                    <td>${datoUser.id}</td>
                    <td>${datoUser.correo}</td>
                    <td>${datoUser.clave}</td>
                    <td>${datoUser.nombre}</td>
                    <td>${datoUser.apellido}</td>
                    <td>${datoUser.perfil}</td>
                    <td><img src="${datoUser.foto}" alt="" width="50px" height="50px"></td>
                </tr>`;
            }
            let table:string = '<table class="table table-dark table-hover">'+cabecera+datoUsuario+'</table>';

            return table;
        }

        public static MostrarAutos():void {
            
            $.ajax({
                type: 'GET',
                url: APIREST + "autos", 
                dataType: "json",
                data: {}, //si es vacio {}
                async: true
        
            })
            .done(function (resultado:any) {
                console.log(resultado);
                if(resultado.exito == false || resultado.exito == undefined){
                    var alert:string = ArmarAlert(resultado.mensaje,"danger");
                    $('#danger').html(alert);
                }else{
                    console.log(resultado.datos);
                    var datos = JSON.parse(resultado.datos);
                    $('#tableAutos').html(Principal.CrearListadoAutos(datos));
                }
                
            })
            .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });    
        
        }

        public static CrearListadoAutos(datos:any){
            let cabecera:string = `
            <tr>
                <th>Marca</th>
                <th>Color</th>
                <th>Modelo</th>
                <th>Precio</th>
            </tr>`;
            let datoAutos:string = "";
            for (const datoAuto of datos) {
                datoAutos += 
                `<tr>
                    <td>${datoAuto.marca}</td>
                    <td>${datoAuto.color}</td>
                    <td>${datoAuto.modelo}</td>
                    <td>${datoAuto.precio}</td>
                </tr>`;
            }
            let table:string = '<table class="table table-striped">'+cabecera+datoAutos+'</table>';

            return table;
        }


        

    }
}