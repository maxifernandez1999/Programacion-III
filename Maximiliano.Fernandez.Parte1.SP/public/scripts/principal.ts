/// <reference path="../node_modules/@types/jquery/index.d.ts" />
$(function() {
    $("#btnUsuarios").on("click",Manager.Principal.MostrarUsuarios);
    $("#btnAutos").on("click",Manager.Principal.MostrarAutos); 
    $("#btnDeleteAuto").on("click",Manager.Principal.DeleteAuto);
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
                    $('[data-action="eliminar"]').on('click', function (e) {
                
                        let id_auto_string:any = $(this).attr("data-auto");
                        let id_auto = parseInt(id_auto_string,10);         
                        Principal.DeleteAuto(id_auto); 
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

        public static CrearListadoAutos(datos:any){
            let cabecera:string = `
            <tr>
                <th>Marca</th>
                <th>Color</th>
                <th>Modelo</th>
                <th>Precio</th>
                <th>Borrar</th>
                <th>Modificar</th>
            </tr>`;
            let datoAutos:string = "";
            for (const datoAuto of datos) {
                datoAutos += 
                `<tr>
                    <td>${datoAuto.marca}</td>
                    <td>${datoAuto.color}</td>
                    <td>${datoAuto.modelo}</td>
                    <td>${datoAuto.precio}</td>
                    <td><button class="btn-danger" data-auto="${datoAuto.id}" data-action='eliminar'>Borrar</button></td>
                    <td><button class="btn-info">Modificar</button></td>
                </tr>`;
            }
            let table:string = '<table class="table table-striped">'+cabecera+datoAutos+'</table>';

            return table;
        }

        public static DeleteAuto(id_auto:any):void {
            
            let data:any = {"id_auto":id_auto};
            let resultado = window.confirm('Estas seguro de que desea eliminar el usuario (id = '+id_auto+')?');
            let token:any = localStorage.getItem("jwt");
            let form:any = new FormData();
            form.append("id_auto", id_auto);
            if (resultado === true) {
                $.ajax({
                    type: 'DELETE',
                    url: APIREST, 
                    dataType: "json",
                    data: form, //si es vacio {}
                    headers : {"token":token,"content-type":"application/json"},
                    async: true,
                    processData: false, 
                    contentType: false 
                })
                .done(function (resultado:any) {
                    console.log(resultado);
                    if(resultado.exito == false || resultado.exito == undefined && resultado.mensaje == "No propietario"){
                        var alert:string = ArmarAlert(resultado.mensaje,"warning");
                        $('#danger').html(alert);
                    }else if(resultado.exito == false || resultado.exito == undefined && resultado.mensaje == "jwt invalido"){
                        $(location).attr('href',APIREST + "front-end");
                    }else{
                        Principal.MostrarAutos();
                    }
                    
                })
                .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
                    alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
                });    
            }else { 
                window.alert('Operacion cancelada');
            }
            
        
        }

        

    }
}