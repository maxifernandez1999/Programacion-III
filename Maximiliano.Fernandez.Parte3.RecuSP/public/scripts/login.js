"use strict";
///<reference path="../node_modules/@types/jquery/index.d.ts" />
var APIREST = "http://RecuSP_api/";
$(function () {
    $("#btnEnviar").on("click", Manager.Login.Login);
    $("#btnLimpiar").on("click", Manager.Login.Limpiar);
    $("#btnLogin").on("click", Manager.Login.Registrar);
});
function ArmarAlert(mensaje, tipo) {
    if (tipo === void 0) { tipo = "success"; }
    var alerta = '<div id="alert_' + tipo + '" class="alert alert-' + tipo + ' alert-dismissable fade show" role="alert">';
    alerta += "" + mensaje;
    alerta += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    return alerta;
}
var Manager;
(function (Manager) {
    var Login = /** @class */ (function () {
        function Login() {
        }
        Login.Login = function () {
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
                if (resultado.exito == false) {
                    var alert_1 = ArmarAlert(resultado.mensaje, "danger");
                    $('#alertLogin').html(alert_1);
                }
                else {
                    localStorage.setItem("jwt", resultado.jwt);
                    $(location).attr('href', APIREST + "principal");
                }
                console.log(resultado.exito);
            })
                .fail(function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });
        };
        Login.Limpiar = function () {
            $("#correoLogin").val("");
            $("#claveLogin").val("");
        };
        Login.Registrar = function () {
            $(location).attr('href', APIREST + "registrousuarios");
        };
        return Login;
    }());
    Manager.Login = Login;
})(Manager || (Manager = {}));
//# sourceMappingURL=login.js.map