/// <reference path="../node_modules/@types/jquery/index.d.ts" />

namespace Manager{
    export class Registro{
        public static AgregarUser():void {
            $("#btnRegistrar").on("click", function(){
                let correo:any = $("#correo").val();
                let clave:any = $("#clave").val();
                let nombre:any = $("#nombre").val();
                let apellido:any = $("#apellido").val();
                let perfil:any = $("#perfil").val();
                let foto:any = $("#file");
            
            
                let form : FormData = new FormData(); 
                let fotoName = <string>$("#foto").val();
                let pathFoto = (fotoName.split('\\'))[2];
                        let json = '{"correo":"' + correo +
                            '","clave":"' + clave +
                            '","nombre":"' + nombre +
                            '","apellido":"' + apellido +
                            '","perfil":"' + perfil +
                            '","foto":"' + pathFoto + '"}';
                            form.append("usuario", json);
                            form.append("foto", foto.files[0]);
                //let data:any = `user={"correo":"${correo}","clave":${clave}}`;
                
                ///cambiar a partir de aca
                $.ajax({
                    type: 'POST',
                    url: APIREST + "usuarios", 
                    dataType: "json",
                    data: form, //si es vacio {}
                    async: true
            
                })
                .done(function (resultado:any) {
                    console.log(resultado);
                    if(resultado.exito == false || resultado.exito == undefined){
                        var alert:string = '<div class="alert alert-danger" role="alert">'+resultado.mensaje+'</div>';
                        $('#danger').html(alert);
                    }else{
                        $(location).attr('href',APIREST + "front-end");
                    }
                    
                })
                .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
                    alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
                });    
            });

        

        }
        public static Limpiar(){
            $("#btnLimpiar").on("click", function(){
                $("#correo").val("");
                $("#clave").val("");
                $("#nombre").val("");
                $("#apellido").val("");
                $("#perfil").val("");
                $("#file").val("");
            });
        }
        
    
    
    
    }
}