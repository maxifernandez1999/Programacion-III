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
                    var table:string = `<table class="table table-dark table-hover">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Nombre 1</td>
                        <td>Username 1</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Nombre 1</td>
                        <td>Username 2</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Nombre 3</td>
                        <td>Username 3</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Nombre 4</td>
                        <td>Username 4</td>
                    </tr>
                </table>`;
                    $('#tableUser').html(table);
                }
                
            })
            .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });    
        
        }

    }
}