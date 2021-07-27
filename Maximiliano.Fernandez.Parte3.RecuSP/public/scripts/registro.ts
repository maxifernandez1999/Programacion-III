/// <reference path="../node_modules/@types/jquery/index.d.ts" />
$(function() {
    $("#btnLimpiarNuevoUsuario").on("click", Manager.Registro.Limpiar);
    $("#btnRegistrar").on("click", Manager.Registro.AgregarUser);
    
});
namespace Manager{
    export class Registro{
        public static AgregarUser():void {
                let correo:any = $("#correo").val();
                let clave:any = $("#clave").val();
                let nombre:any = $("#nombre").val();
                let apellido:any = $("#apellido").val();
                let id_perfil:any = <Number>$("#perfil").val();
                let foto:any = $("#file")[0];
            
            
                let form : FormData = new FormData();
                        let json = '{"correo":"' + correo +
                            '","clave":"' + clave +
                            '","nombre":"' + nombre +
                            '","apellido":"' + apellido +
                            '","foto":"' + foto +
                            '","id_perfil":"' + parseInt(id_perfil,10) +
                            '"}';
                            form.append("usuario", json);
                            form.append("foto", foto.files[0]);

                $.ajax({
                    type: 'POST',
                    url: APIREST + "usuario", 
                    dataType: "json",
                    data: form, //si es vacio {}
                    async: true,
                    processData: false, 
                    contentType: false
            
                })
                .done(function (resultado:any) {
                    console.log(resultado);
                    if(resultado.exito == false){
                        var alert:string = ArmarAlert(resultado.mensaje,"danger");
                        $('#alertRegistro').html(alert);
                    }else{
                        $(location).attr('href',APIREST + "front-end");
                    }
                    
                })
                .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
                    alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
                });    

        

        }
        public static Limpiar(){
            $("#correo").val("");
            $("#clave").val("");
            $("#nombre").val("");
            $("#apellido").val("");
            $("#perfil").val("");
            $("#file").val("");
        }
        
    
    
    
    }
}