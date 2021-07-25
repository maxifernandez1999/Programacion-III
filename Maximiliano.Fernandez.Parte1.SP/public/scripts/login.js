"use strict";
/// <reference path="../node_modules/@types/jquery/index.d.ts" />
var APIREST = "http://2doParcial_api/";
$(function () {
    $("#btnEnviar").on("click", Manager.Login.Login);
    $("#btnLimpiar").on("click", Manager.Login.Limpiar);
});
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
                if (resultado.exito == false || resultado.exito == undefined) {
                    var alert = '<div class="alert alert-danger" role="alert">' + resultado.mensaje + '</div>';
                    $('#danger').html(alert);
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
        return Login;
    }());
    Manager.Login = Login;
})(Manager || (Manager = {}));
//# sourceMappingURL=login.js.map