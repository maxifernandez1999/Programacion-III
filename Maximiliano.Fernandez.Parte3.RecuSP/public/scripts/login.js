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
function ArmarVentanaModal() {
    var modal = "\n    <div class=\"modal fade\" id=\"exampleModal\" tabindex=\"-1\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">\n      <div class=\"modal-dialog\">\n        <div class=\"modal-content\">\n          <div class=\"modal-body\">\n            <!-- descripcion -->\n            <div class=\"m-3\">\n                    <label for=\"exampleInputEmail1\" class=\"form-label\">Descripcion</label>\n                    <i class=\"fas fa-trademark\"></i>\n                    <input type=\"text\" class=\"form-control\" id=\"descripcion\" aria-describedby=\"emailHelp\">\n                </div>\n                <!-- estado -->\n                <div class=\"m-3\">\n                <label for=\"exampleInputPassword1\" class=\"form-label\">Perfil</label>\n                <i class=\"fas fa-id-card\"></i>\n                <select class=\"form-select form-select-lg mb-3 far fa-id-card\" aria-label=\".form-select-lg example\" id=\"estado\">\n                    <option value=\"1\" selected>Activo</option>\n                    <option value=\"0\">Inactivo</option>\n                </select>\n                </div>  \n          </div>\n        </div>\n      </div>\n    </div>";
    return modal;
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