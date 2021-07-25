"use strict";
/// <reference path="../node_modules/@types/jquery/index.d.ts" />
var Manager;
(function (Manager) {
    var Registro = /** @class */ (function () {
        function Registro() {
        }
        Registro.AgregarUser = function () {
            $("#btnRegistrar").on("click", function () {
                var correo = $("#correo").val();
                var clave = $("#clave").val();
                var nombre = $("#nombre").val();
                var apellido = $("#apellido").val();
                var perfil = $("#perfil").val();
                var foto = $("#file");
                var form = new FormData();
                var fotoName = $("#foto").val();
                var pathFoto = (fotoName.split('\\'))[2];
                var json = '{"correo":"' + correo +
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
                    data: form,
                    async: true
                })
                    .done(function (resultado) {
                    console.log(resultado);
                    if (resultado.exito == false || resultado.exito == undefined) {
                        var alert = '<div class="alert alert-danger" role="alert">' + resultado.mensaje + '</div>';
                        $('#danger').html(alert);
                    }
                    else {
                        $(location).attr('href', APIREST + "front-end");
                    }
                })
                    .fail(function (jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
                });
            });
        };
        Registro.Limpiar = function () {
            $("#btnLimpiar").on("click", function () {
                $("#correo").val("");
                $("#clave").val("");
                $("#nombre").val("");
                $("#apellido").val("");
                $("#perfil").val("");
                $("#file").val("");
            });
        };
        return Registro;
    }());
    Manager.Registro = Registro;
})(Manager || (Manager = {}));
//# sourceMappingURL=registro.js.map