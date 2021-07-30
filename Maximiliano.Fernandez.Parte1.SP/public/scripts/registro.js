"use strict";
/// <reference path="../node_modules/@types/jquery/index.d.ts" />
$(function () {
    $("#btnLimpiarNuevoUsuario").on("click", Manager.Registro.Limpiar);
    $("#btnRegistrar").on("click", Manager.Registro.AdministradoraDeValidaciones);
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
                if (resultado.exito == false || resultado.exito == undefined || resultado.status == 403) {
                    var alert = ArmarAlert(resultado.mensaje, "danger");
                    $('#divalertregister').html(alert);
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
        Registro.AdministradoraDeValidaciones = function () {
            var retorno = true;
            var alert = "";
            if (Registro.ValidarCamposVacios($("#correo").val()) == false) {
                retorno = false;
                alert += ArmarAlert("campo correo vacio", "danger");
            }
            if (Registro.ValidarCamposVacios($("#clave").val()) == false) {
                if (Registro.ValidarCantidadDeCaracteres($("#clave").val(), 4, 8) == false) {
                    retorno = false;
                    alert += ArmarAlert("campo clave vacio o  rango incorrecto", "danger");
                }
            }
            if (Registro.ValidarCamposVacios($("#nombre").val()) == false) {
                if (Registro.ValidarCantidadDeCaracteres($("#nombre").val(), 4, 10) == false) {
                    retorno = false;
                    alert += ArmarAlert("campo nombre vacio o  rango incorrecto", "danger");
                }
            }
            if (Registro.ValidarCamposVacios($("#apellido").val()) == false) {
                if (Registro.ValidarCantidadDeCaracteres($("#apellido").val(), 2, 15) == false) {
                    retorno = false;
                    alert += ArmarAlert("campo apellido vacio o  rango incorrecto", "danger");
                }
            }
            if (Registro.ValidarCamposVacios($("#perfil").val()) == false) {
                if (Registro.ValidarCombo($("#perfil").val(), "nulo") == false) {
                    retorno = false;
                    alert += ArmarAlert("campo perfil incorrecto o vacio", "danger");
                }
            }
            if (Registro.ValidarCamposVacios($("#file").val()) == false) {
                retorno = false;
                alert += ArmarAlert("campo file vacio", "danger");
            }
            if (retorno != false) {
                Registro.AgregarUser();
            }
            else {
                $('#divalertregister').html(alert);
            }
        };
        Registro.ValidarCamposVacios = function (id) {
            if (id != "") {
                return true;
            }
            return false;
        };
        Registro.ValidarCantidadDeCaracteres = function (valor, min, max) {
            var valorSplip = valor.split("");
            if (valorSplip.length >= min && valorSplip.length <= max) {
                return true;
            }
            return false;
        };
        Registro.ValidarCombo = function (valorid, valorNoDeseado) {
            if (valorid == valorNoDeseado) {
                return false;
            }
            return true;
        };
        return Registro;
    }());
    Manager.Registro = Registro;
})(Manager || (Manager = {}));
//# sourceMappingURL=registro.js.map