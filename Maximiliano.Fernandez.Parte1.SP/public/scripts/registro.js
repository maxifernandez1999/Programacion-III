"use strict";
/// <reference path="../node_modules/@types/jquery/index.d.ts" />
$(function () {
    $("#btnLimpiarNuevoUsuario").on("click", Manager.Registro.Limpiar);
    $("#btnRegistrar").on("click", Manager.Registro.AgregarUser);
});
var Manager;
(function (Manager) {
    var Registro = /** @class */ (function () {
        function Registro() {
        }
        Registro.AgregarUser = function () {
            var correo = $("#correo").val();
            var clave = $("#clave").val();
            var nombre = $("#nombre").val();
            var apellido = $("#apellido").val();
            var perfil = $("#perfil").val();
            var foto = $("#file")[0];
            var form = new FormData();
            var json = '{"correo":"' + correo +
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
                data: form,
                async: true,
                processData: false,
                contentType: false
            })
                .done(function (resultado) {
                console.log(resultado);
                if (resultado.exito == false || resultado.exito == undefined) {
                    var alert = ArmarAlert(resultado.mensaje, "danger");
                    $('#danger').html(alert);
                }
                else {
                    $(location).attr('href', APIREST + "front-end");
                }
            })
                .fail(function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });
        };
        Registro.Limpiar = function () {
            $("#correo").val("");
            $("#clave").val("");
            $("#nombre").val("");
            $("#apellido").val("");
            $("#perfil").val("");
            $("#file").val("");
        };
        return Registro;
    }());
    Manager.Registro = Registro;
})(Manager || (Manager = {}));
//# sourceMappingURL=registro.js.map