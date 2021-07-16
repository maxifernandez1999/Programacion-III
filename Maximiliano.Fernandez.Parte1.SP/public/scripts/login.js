"use strict";
/// <reference path="../node_modules/@types/jquery/index.d.ts" />
var APIREST = "http://2doParcial_api/";
function Login() {
    // Asociar al evento click del botón btnEnviar una función que recupere el correo y la clave para luego
    // invocar al verbo POST de la ruta /login (de la Api Rest).
    // (POST) /login
    // Se envía un JSON → user (correo y clave) y retorna un JSON (éxito: true/false; jwt: JWT (con todos los datos del
    // usuario) / null; status: 200/403).
    // Si el atributo éxito del json de retorno es false, se mostrará (en un alert de BOOTSTRAP - danger) un
    // mensaje que indique lo acontecido.
    // Si es true, se guardará en el LocalStorage el JWT obtenido y se redireccionará hacia principal.php.
    // El botón ‘Quiero Registrarme!’ llevará al usuario hacia la página registro.html
    //LIMPIO EL CONTENIDO DEL DIV    
    var correo = $("#correoLogin").val();
    var clave = Number($("#claveLogin").val());
    var data = "user={\"correo\":\"" + correo + "\",\"clave\":" + clave + "}";
    $.ajax({
        type: 'POST',
        url: APIREST + "login",
        dataType: "json",
        data: data,
        async: true
    })
        .done(function (resultado) {
        console.log(resultado);
        //no esta seteado el exito true
        if (resultado.exito == false || resultado.exito == undefined) {
            var alert = '<div class="alert alert-danger" role="alert">' + resultado.mensaje + '</div>';
        }
        else {
            localStorage.setItem("jwt", resultado.jwt);
            window.location.replace("../src/views/principal.html");
        }
        console.log(resultado.exito);
        //$("#divResultado").html(alert);
    })
        .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}
//# sourceMappingURL=login.js.map