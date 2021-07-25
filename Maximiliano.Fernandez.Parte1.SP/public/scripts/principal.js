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
                    var table = "<table class=\"table table-dark table-hover\">\n                    <tr>\n                        <th>Id</th>\n                        <th>Nombre</th>\n                        <th>Usuario</th>\n                    </tr>\n                    <tr>\n                        <td>1</td>\n                        <td>Nombre 1</td>\n                        <td>Username 1</td>\n                    </tr>\n                    <tr>\n                        <td>2</td>\n                        <td>Nombre 1</td>\n                        <td>Username 2</td>\n                    </tr>\n                    <tr>\n                        <td>3</td>\n                        <td>Nombre 3</td>\n                        <td>Username 3</td>\n                    </tr>\n                    <tr>\n                        <td>4</td>\n                        <td>Nombre 4</td>\n                        <td>Username 4</td>\n                    </tr>\n                </table>";
                    $('#tableUser').html(table);
                }
            })
                .fail(function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });
        };
        return Principal;
    }());
    Manager.Principal = Principal;
})(Manager || (Manager = {}));
//# sourceMappingURL=principal.js.map