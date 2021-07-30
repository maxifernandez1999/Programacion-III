"use strict";
/// <reference path="../node_modules/@types/jquery/index.d.ts" />
$(function () {
    $("#btnUsuarios").on("click", Manager.Principal.MostrarUsuarios);
    $("#btnAutos").on("click", Manager.Principal.MostrarAutos);
    $("#logout").on("click", Manager.Principal.Logout);
});
var Manager;
(function (Manager) {
    var Principal = /** @class */ (function () {
        function Principal() {
        }
        Principal.Logout = function () {
            localStorage.removeItem("token");
            $(location).attr('href', APIREST + "front-end");
        };
        Principal.VerificarToken = function () {
            var token = localStorage.getItem("token");
            $.ajax({
                type: 'GET',
                url: APIREST + "login",
                dataType: "json",
                data: {},
                headers: { "token": token, "content-type": "application/json" },
                async: true
            })
                .done(function (resultado) {
                console.log(resultado);
                if (resultado.status == 403) {
                    $(location).attr('href', APIREST + "front-end");
                }
            })
                .fail(function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });
        };
        Principal.MostrarUsuarios = function () {
            Principal.VerificarToken();
            $.ajax({
                type: 'GET',
                url: APIREST,
                dataType: "json",
                data: {},
                async: true
            })
                .done(function (resultado) {
                console.log(resultado);
                if (resultado.exito == false || resultado.exito == undefined) {
                    var alert = ArmarAlert(resultado.mensaje, "danger");
                    $('#danger').html(alert);
                }
                else {
                    console.log(resultado.dato);
                    var datos = JSON.parse(resultado.dato);
                    $('#tableUser').html(Principal.CrearListadoUsuarios(datos));
                }
            })
                .fail(function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });
        };
        Principal.CrearListadoUsuarios = function (datos) {
            var cabecera = "\n            <tr>\n                <th>Id</th>\n                <th>Correo</th>\n                <th>Clave</th>\n                <th>Nombre</th>\n                <th>Apellido</th>\n                <th>Perfil</th>\n                <th>Foto</th>\n            </tr>";
            var datoUsuario = "";
            for (var _i = 0, datos_1 = datos; _i < datos_1.length; _i++) {
                var datoUser = datos_1[_i];
                datoUsuario +=
                    "<tr>\n                    <td>" + datoUser.id + "</td>\n                    <td>" + datoUser.correo + "</td>\n                    <td>" + datoUser.clave + "</td>\n                    <td>" + datoUser.nombre + "</td>\n                    <td>" + datoUser.apellido + "</td>\n                    <td>" + datoUser.perfil + "</td>\n                    <td><img src=\"" + datoUser.foto + "\" alt=\"\" width=\"50px\" height=\"50px\"></td>\n                </tr>";
            }
            var table = '<table class="table table-dark table-hover">' + cabecera + datoUsuario + '</table>';
            return table;
        };
        Principal.MostrarAutos = function () {
            $.ajax({
                type: 'GET',
                url: APIREST + "autos",
                dataType: "json",
                data: {},
                async: true
            })
                .done(function (resultado) {
                console.log(resultado);
                if (resultado.exito == false || resultado.exito == undefined) {
                    var alert = ArmarAlert(resultado.mensaje, "danger");
                    $('#danger').html(alert);
                }
                else {
                    console.log(resultado.datos);
                    var datos = JSON.parse(resultado.datos);
                    $('#tableAutos').html(Principal.CrearListadoAutos(datos));
                }
            })
                .fail(function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });
        };
        Principal.CrearListadoAutos = function (datos) {
            var cabecera = "\n            <tr>\n                <th>Marca</th>\n                <th>Color</th>\n                <th>Modelo</th>\n                <th>Precio</th>\n            </tr>";
            var datoAutos = "";
            for (var _i = 0, datos_2 = datos; _i < datos_2.length; _i++) {
                var datoAuto = datos_2[_i];
                datoAutos +=
                    "<tr>\n                    <td>" + datoAuto.marca + "</td>\n                    <td>" + datoAuto.color + "</td>\n                    <td>" + datoAuto.modelo + "</td>\n                    <td>" + datoAuto.precio + "</td>\n                </tr>";
            }
            var table = '<table class="table table-striped">' + cabecera + datoAutos + '</table>';
            return table;
        };
        return Principal;
    }());
    Manager.Principal = Principal;
})(Manager || (Manager = {}));
//# sourceMappingURL=principal.js.map