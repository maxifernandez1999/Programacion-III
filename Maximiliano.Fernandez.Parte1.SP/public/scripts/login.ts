/// <reference path="../node_modules/@types/jquery/index.d.ts" />
const APIREST:string = "http://2doParcial_api/";
$(function() {
    $("#btnEnviar").on("click",Manager.Login.Login); 
    $("#btnLimpiar").on("click", Manager.Login.Limpiar);
});
namespace Manager{
    
    export class Login{
        public static Login():void {
            let correo:any = $("#correoLogin").val();
            let clave:number = Number($("#claveLogin").val());
            let data:any = `user={"correo":"${correo}","clave":${clave}}`;
            $.ajax({
                type: 'POST',
                url: APIREST + "login", 
                dataType: "json",
                data: data, //si es vacio {}
                async: true
        
            })
            .done(function (resultado:any) {
                console.log(resultado);
                //no esta seteado el exito true
                if(resultado.exito == false || resultado.exito == undefined){
                    var alert:string = '<div class="alert alert-danger" role="alert">'+resultado.mensaje+'</div>';
                    $('#danger').html(alert);
                }else{
                    localStorage.setItem("jwt", resultado.jwt);
                    $(location).attr('href',APIREST + "principal");
                }
                console.log(resultado.exito);
                
            })
            .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            }); 
        
            
        }
        public static Limpiar(){
            $("#correoLogin").val("");
            $("#claveLogin").val("");
        }
    }
   

    

       
       
}
