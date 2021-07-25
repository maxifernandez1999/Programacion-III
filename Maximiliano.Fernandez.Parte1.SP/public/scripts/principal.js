"use strict";
/// <reference path="../node_modules/@types/jquery/index.d.ts" />
$(function () {
    $("#btnUsuarios").on("click", Manager.Principal.AgregarUser);
});
var Manager;
(function (Manager) {
    var Principal = /** @class */ (function () {
        function Principal() {
        }
        Principal.AgregarUser = function () {
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
                    var alert = '<div class="alert alert-danger" role="alert">' + resultado.mensaje + '</div>';
                    $('#danger').html(alert);
                }
                else {
                    console.log(resultado.dato);
                    var datos = JSON.parse(resultado.dato);
                    $('#tableUser').html(Principal.CrearListado(datos));
                }
            })
                .fail(function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });
        };
        Principal.CrearListado = function (datos) {
            var cabecera = "\n            <tr>\n                <th>Id</th>\n                <th>Correo</th>\n                <th>Clave</th>\n                <th>Nombre</th>\n                <th>Apellido</th>\n                <th>Perfil</th>\n                <th>Foto</th>\n            </tr>";
            var datoUsuario = "";
            for (var _i = 0, datos_1 = datos; _i < datos_1.length; _i++) {
                var datoUser = datos_1[_i];
                datoUsuario +=
                    "<tr>\n                    <td>" + datoUser.id + "</td>\n                    <td>" + datoUser.correo + "</td>\n                    <td>" + datoUser.clave + "</td>\n                    <td>" + datoUser.nombre + "</td>\n                    <td>" + datoUser.apellido + "</td>\n                    <td>" + datoUser.perfil + "</td>\n                    <td><img src=\"../../src/fotos/" + datoUser.foto + "\" alt=\"\"></td>\n                </tr>";
            }
            var table = '<table class="table table-dark table-hover">' + cabecera + datoUsuario + '</table>';
            return table;
        };
        return Principal;
    }());
    Manager.Principal = Principal;
})(Manager || (Manager = {}));
//# sourceMappingURL=principal.js.map