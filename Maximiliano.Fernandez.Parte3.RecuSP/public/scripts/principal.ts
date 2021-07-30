/// <reference path="../node_modules/@types/jquery/index.d.ts" />
$(function() {
    $("#btnUsuarios").on("click",Manager.Principal.MostrarUsuarios);
    $("#btnPerfiles").on("click",Manager.Principal.MostrarPerfiles); 
    $("#btnDeleteAuto").on("click",Manager.Principal.DeletePerfil);
    $("#filter").on("click",Manager.Principal.FiltrarPerfiles);
    $("#agregarPerfil").on("click",Manager.Principal.BtnOK);
    $("#deleteUser").on("click",Manager.Principal.DeleteUsuario);
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
                    <td><img src="../../src/fotos/${datoUser.foto}" alt="" width="50px" height="50px"></td>
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
                
                        let id_perfil_string:any = $(this).attr("data-perfil");
                        let id_perfil = parseInt(id_perfil_string,10);
                        let resultado = window.confirm('Estas seguro de que desea eliminar el usuario (id = '+id_perfil+')?');  
                        if (resultado === true) {
                            Principal.DeletePerfil(id_perfil);
                        }else { 
                            window.alert('Operacion cancelada');
                        }
                         
                    });
                    $('[data-action="modificar"]').on('click', function (e) {
                
                        var id_perfil_modificar:any = $(this).attr("data-perfil");
                        $('#buttonOK').on('click', function (e) {
                            var datosModificar:any = {"descripcion":$('#descripcionModificar').val(),"estado":parseInt(<string>$('#estadoModificar').val(),10)};
                            let resultado = window.confirm('Estas seguro de que desea eliminar el usuario (id = '+id_perfil_modificar+')?');  
                            if (resultado === true) {
                                Principal.ModificarPerfil(id_perfil_modificar,datosModificar);
                            }else { 
                                window.alert('Operacion cancelada');
                            }
                             
                        });
                        
                         
                    });
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
            for (const datoPerfil of datos) {
                datosPerfiles += 
                `<tr>
                    <td>${datoPerfil.descripcion}</td>
                    <td>${datoPerfil.estado}</td>
                    <td><button class="btn-danger" data-perfil="${datoPerfil.id}" data-action='eliminar'>Borrar</button></td>
                    <td><button type="button" class="btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-action="modificar" data-perfil="${datoPerfil.id}">
                    Modificar</button></td>
                </tr>`;
            }
            // <td><button class="btn-info" data-perfil="${datoPerfil}" data-action="modificar">Modificar</button></td>
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
                if(resultado.exito == false || resultado.status == 403){
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
        public static ModificarPerfil(id_perfil_modificar:any,datosModificar:any):void {
            
            let token:any = localStorage.getItem("jwt");
            let json:any = {"id_perfil":id_perfil_modificar,"perfil":{"descripcion":datosModificar.descripcion,"estado":datosModificar.estado}};
            $.ajax({
                type: 'PUT',
                url: APIREST + "perfiles/", 
                dataType: "json",
                data: JSON.stringify(json), //si es vacio {}
                headers : {"token":token,"content-type":"application/json"},
                async: true
            })
            .done(function (resultado:any) {
                console.log(resultado);
                if(resultado.exito == false || resultado.status == 403){
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

        public static FiltrarPerfiles(){
            $.ajax({
                type: 'GET',
                url: APIREST + "perfil", 
                dataType: "json",
                data: {}, //si es vacio {}
                async: true
        
            })
            .done(function (resultado:any) {
                let datosFiltrados = Principal.Filter(JSON.parse(resultado.dato));
                $('#tablePerfiles').html(Principal.CrearListadoPerfiles(datosFiltrados));
            })
            .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });    
        }

        public static Filter(perfiles:any){
            
            let activos = perfiles.filter((perfil:any) => perfil.estado === "1");
            return activos;
        }
        public static Map(usuarios:any){
            let nombres_fotos = usuarios.map((usuario:any) => usuario.nombre && usuario.foto);
            return nombres_fotos;
        }
        public static Reduce(usuarios:any){
            
            let totalStock = usuarios.reduce((anterior:any, actual:any) => anterior + actual.stock, 0);
            return totalStock;
        }
        public static ObtenerDatosPerfil(){
            let descripcion:any = $('#descripcionAlta').val();
            let estado:any = $('#estadoAlta').val();
            let jsonPerfil:any = {};
            jsonPerfil.descripcion = descripcion;
            jsonPerfil.estado = parseInt(estado,10);
            return JSON.stringify(jsonPerfil);


        }
        public static BtnOK(){
            $('#btnOKAlta').on('click', function (e) {
                var datosModificar:any = Principal.ObtenerDatosPerfil();
                let resultado = window.confirm('Estas seguro de que desea agregar el usuario?');  
                if (resultado === true) {
                    e.preventDefault();
                    Principal.AgregarPerfil(datosModificar);
                    
                }else { 
                    window.alert('Operacion cancelada');
                }
                 
            });
        }
        public static AgregarPerfil(data:any):void {
            
            $.ajax({
                type: 'POST',
                url: APIREST, 
                dataType: "json",
                data: `perfil=${data}`, //si es vacio {}
                async: true
        
            })
            .done(function (resultado:any) {
                console.log(resultado);
                if(resultado.exito == false || resultado.status == 403){
                    var alert:string = ArmarAlert(resultado.mensaje,"danger");
                    $('#alertPrincipal').html(alert);
                }else{
                    var alert:string = ArmarAlert(resultado.mensaje,"success");
                    $('#alertPrincipal').html(alert);
                }
                
            })
            .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });    
        
        }
        public static DeleteUsuario(id_usuario:any):void {
            
            let data:any = {"id_usuario":id_usuario};
            
            let token:any = localStorage.getItem("jwt");
            
            $.ajax({
                type: 'DELETE',
                url: APIREST + "usuarios/", 
                dataType: "json",
                data: JSON.stringify(data), //si es vacio {}
                headers : {"token":token,"content-type":"application/json"},
                async: true
            })
            .done(function (resultado:any) {
                console.log(resultado);
                if(resultado.exito == false || resultado.status == 403){
                    var alert:string = ArmarAlert(resultado.mensaje,"warning");
                    $('#alertPrincipal').html(alert);
                }else{
                    Principal.MostrarUsuarios();
                }
                
            })
            .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });    
            
            
        
        }

    }
}