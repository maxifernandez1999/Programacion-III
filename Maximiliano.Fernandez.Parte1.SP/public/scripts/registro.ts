/// <reference path="../node_modules/@types/jquery/index.d.ts" />
$(function() {
    $("#btnLimpiarNuevoUsuario").on("click", Manager.Registro.Limpiar);
    $("#btnRegistrar").on("click", Manager.Registro.AdministradoraDeValidaciones);
    
});
namespace Manager{
    export class Registro{
        public static AgregarUser():void {
                let correo:any = $("#correo").val();
                let clave:any = $("#clave").val();
                let nombre:any = $("#nombre").val();
                let apellido:any = $("#apellido").val();
                let perfil:any = $("#perfil").val();
                let foto:any = $("#file")[0];
            
            
                let form : FormData = new FormData();
                        let json = '{"correo":"' + correo +
                            '","clave":"' + clave +
                            '","nombre":"' + nombre +
                            '","apellido":"' + apellido +
                            '","perfil":"' + perfil +
                            '"}';
                            form.append("user", json);
                            form.append("foto", foto.files[0]);

                $.ajax({
                    type: 'POST',
                    url: APIREST + "usuarios", 
                    dataType: "json",
                    data: form, //si es vacio {}
                    async: true,
                    processData: false, 
                    contentType: false
            
                })
                .done(function (resultado:any) {
                    console.log(resultado);
                    if(resultado.exito == false || resultado.exito == undefined || resultado.status == 403){
                        var alert:string = ArmarAlert(resultado.mensaje,"danger");
                        $('#divalertregister').html(alert);
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
        public static AdministradoraDeValidaciones(){
            var retorno:boolean = true;
            var alert:string = "";
            if(Registro.ValidarCamposVacios(<string>$("#correo").val()) == false){
                retorno = false;
                alert += ArmarAlert("campo correo vacio","danger");
                
            }
            if(Registro.ValidarCamposVacios(<string>$("#clave").val()) == false){
                if(Registro.ValidarCantidadDeCaracteres(<string>$("#clave").val(),4,8) == false){
                    retorno = false;
                    alert += ArmarAlert("campo clave vacio o  rango incorrecto","danger");
                   
                }
            }
            if(Registro.ValidarCamposVacios(<string>$("#nombre").val()) == false){
                if(Registro.ValidarCantidadDeCaracteres(<string>$("#nombre").val(),4,10) == false){
                    retorno = false;
                    alert += ArmarAlert("campo nombre vacio o  rango incorrecto","danger");
                    
                }
            }
            if(Registro.ValidarCamposVacios(<string>$("#apellido").val()) == false){
                if(Registro.ValidarCantidadDeCaracteres(<string>$("#apellido").val(),2,15) == false){
                    retorno = false;
                    alert += ArmarAlert("campo apellido vacio o  rango incorrecto","danger");
                    
                }
            }
            if(Registro.ValidarCamposVacios(<string>$("#perfil").val()) == false){
                if(Registro.ValidarCombo(<string>$("#perfil").val(),"nulo") == false){
                    retorno = false;
                    alert += ArmarAlert("campo perfil incorrecto o vacio","danger");
                    
                    
                }
            }
            if(Registro.ValidarCamposVacios(<string>$("#file").val()) == false){
                retorno = false;
                alert += ArmarAlert("campo file vacio","danger");

            }
            if(retorno != false){
                Registro.AgregarUser();
            }else{
                $('#divalertregister').html(alert);
            }
        }

        public static ValidarCamposVacios(id:string):boolean{
            if(id != ""){
                return true;
            }
            return false;
        }
        public static ValidarCantidadDeCaracteres(valor:string,min:number,max:number):boolean{
            let valorSplip:string[] = valor.split("");
            if(valorSplip.length >=min && valorSplip.length <=max){
                return true;
            }
            return false;
        }
        public static ValidarCombo(valorid:string,valorNoDeseado:string):boolean{
            if (valorid == valorNoDeseado) {
                return false;
            }
            return true;
        }


        
    
    
    
    }
}