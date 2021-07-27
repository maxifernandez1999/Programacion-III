///<reference path="../node_modules/@types/jquery/index.d.ts" />

const APIREST:string = "http://RecuSP_api/";
$(function() {
    $("#btnEnviar").on("click",Manager.Login.Login); 
    $("#btnLimpiar").on("click", Manager.Login.Limpiar);
    $("#btnLogin").on("click", Manager.Login.Registrar);
    
});
function ArmarAlert(mensaje:string, tipo:string = "success"):string{

    let alerta:string = '<div id="alert_'+tipo+'" class="alert alert-' + tipo + ' alert-dismissable fade show" role="alert">';
    alerta += `${mensaje}`;
    alerta += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    return alerta;
}
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
                if(resultado.exito == false){
                    let alert:string = ArmarAlert(resultado.mensaje,"danger");
                    $('#alertLogin').html(alert);
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

        public static Registrar(){ 
            $(location).attr('href',APIREST + "registrousuarios");    
        }
    }
   

    

       
       
}
