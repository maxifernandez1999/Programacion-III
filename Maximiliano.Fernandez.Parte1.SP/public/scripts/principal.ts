/// <reference path="../node_modules/@types/jquery/index.d.ts" />
$(function() {
    $("#btnUsuarios").on("click",Manager.Principal.AgregarUser); 
});
namespace Manager{
    export class Principal{
        public static AgregarUser():void {
            
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
                    var alert:string = '<div class="alert alert-danger" role="alert">'+resultado.mensaje+'</div>';
                    $('#danger').html(alert);
                }else{
                    console.log(resultado.dato);
                    var datos = JSON.parse(resultado.dato);
                    $('#tableUser').html(Principal.CrearListado(datos));
                }
                
            })
            .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });    
        
        }

        public static CrearListado(datos:any){
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
                    <td><img src="../../src/fotos/${datoUser.foto}" alt=""></td>
                </tr>`;
            }
            let table:string = '<table class="table table-dark table-hover">'+cabecera+datoUsuario+'</table>';

            return table;
        }

    }
}