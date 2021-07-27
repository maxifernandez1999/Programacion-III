/// <reference path="../node_modules/@types/jquery/index.d.ts" />
$(function() {
    $("#btnUsuarios").on("click",Manager.Principal.MostrarUsuarios);
    $("#btnPerfiles").on("click",Manager.Principal.MostrarPerfiles); 
    $("#btnDeleteAuto").on("click",Manager.Principal.DeletePerfil);
});
namespace Manager{
    export class Principal{
        public static MostrarUsuarios():void {
            
            $.ajax({
                type: 'GET',
                url: APIREST, 
                dataType: "json",
                data: {}, //si es vacio {}
                async: true
        
            })
            .done(function (resultado:any) {
                console.log(resultado);
                if(resultado.exito == false){
                    var alert:string = ArmarAlert(resultado.mensaje,"danger");
                    $('#alertPrincipal').html(alert);
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
                <th>foto</th>
                <th>IDPerfil</th>
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
                    <td><img src="${datoUser.foto}" alt="" width="50px" height="50px"></td>
                    <td>${datoUser.id_perfil}</td>
                </tr>`;
            }
            let table:string = '<table class="table table-dark table-hover">'+cabecera+datoUsuario+'</table>';

            return table;
        }

        public static MostrarPerfiles():void {
            
            $.ajax({
                type: 'GET',
                url: APIREST + "perfil", 
                dataType: "json",
                data: {}, //si es vacio {}
                async: true
        
            })
            .done(function (resultado:any) {
                console.log(resultado);
                if(resultado.exito == false){
                    var alert:string = ArmarAlert(resultado.mensaje,"danger");
                    $('#alertPrincipal').html(alert);
                }else{
                    console.log(resultado.dato);
                    var datos = JSON.parse(resultado.dato);
                    $('#tablePerfiles').html(Principal.CrearListadoPerfiles(datos));
                    $('[data-action="eliminar"]').on('click', function (e) {
                
                        let id_perfil_string:any = $(this).attr("data-auto");
                        let id_perfil = parseInt(id_perfil_string,10);
                        let resultado = window.confirm('Estas seguro de que desea eliminar el usuario (id = '+id_perfil+')?');  
                        if (resultado === true) {
                            Principal.DeletePerfil(id_perfil);
                        }else { 
                            window.alert('Operacion cancelada');
                        }
                         
                    });
            
                    // $('[data-action="modificar"]').on('click', function (e) {
        
                    //     let obj_auto_string = $(this).attr("data-auto");
                    //     let obj_auto = JSON.parse(obj_auto_string);
                    // });
                }
                
            })
            .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });    
        
        }

        public static CrearListadoPerfiles(datos:any){
            let cabecera:string = `
            <tr>
                <th>Descripcion</th>
                <th>Estado</th>
                <th>Borrar</th>
                <th>Modificar</th>
            </tr>`;
            let datosPerfiles:string = "";
            for (const datoAuto of datos) {
                datosPerfiles += 
                `<tr>
                    <td>${datoAuto.descripcion}</td>
                    <td>${datoAuto.estado}</td>
                    <td><button class="btn-danger" data-auto="${datoAuto.id}" data-action='eliminar'>Borrar</button></td>
                    <td><button class="btn-info">Modificar</button></td>
                </tr>`;
            }
            let table:string = '<table class="table table-striped">'+cabecera+datosPerfiles+'</table>';

            return table;
        }

        public static DeletePerfil(id_perfil:any):void {
            
            let data:any = {"id_perfil":id_perfil};
            
            let token:any = localStorage.getItem("jwt");
            
            $.ajax({
                type: 'DELETE',
                url: APIREST + "perfiles/", 
                dataType: "json",
                data: JSON.stringify(data), //si es vacio {}
                headers : {"token":token,"content-type":"application/json"},
                async: true
            })
            .done(function (resultado:any) {
                console.log(resultado);
                if(resultado.exito == false){
                    var alert:string = ArmarAlert(resultado.mensaje,"warning");
                    $('#alertPrincipal').html(alert);
                }else{
                    Principal.MostrarPerfiles();
                }
                
            })
            .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });    
            
            
        
        }

        

    }
}