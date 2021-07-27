"use strict";
/// <reference path="../node_modules/@types/jquery/index.d.ts" />
$(function () {
    $("#btnUsuarios").on("click", Manager.Principal.MostrarUsuarios);
    $("#btnPerfiles").on("click", Manager.Principal.MostrarPerfiles);
    $("#btnDeleteAuto").on("click", Manager.Principal.DeletePerfil);
});
var Manager;
(function (Manager) {
    var Principal = /** @class */ (function () {
        function Principal() {
        }
        Principal.MostrarUsuarios = function () {
            $.ajax({
                type: 'GET',
                url: APIREST,
                dataType: "json",
                data: {},
                async: true
            })
                .done(function (resultado) {
                console.log(resultado);
                if (resultado.exito == false) {
                    var alert = ArmarAlert(resultado.mensaje, "danger");
                    $('#alertPrincipal').html(alert);
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
            var cabecera = "\n            <tr>\n                <th>Id</th>\n                <th>Correo</th>\n                <th>Clave</th>\n                <th>Nombre</th>\n                <th>Apellido</th>\n                <th>foto</th>\n                <th>IDPerfil</th>\n            </tr>";
            var datoUsuario = "";
            for (var _i = 0, datos_1 = datos; _i < datos_1.length; _i++) {
                var datoUser = datos_1[_i];
                datoUsuario +=
                    "<tr>\n                    <td>" + datoUser.id + "</td>\n                    <td>" + datoUser.correo + "</td>\n                    <td>" + datoUser.clave + "</td>\n                    <td>" + datoUser.nombre + "</td>\n                    <td>" + datoUser.apellido + "</td>\n                    <td><img src=\"" + datoUser.foto + "\" alt=\"\" width=\"50px\" height=\"50px\"></td>\n                    <td>" + datoUser.id_perfil + "</td>\n                </tr>";
            }
            var table = '<table class="table table-dark table-hover">' + cabecera + datoUsuario + '</table>';
            return table;
        };
        Principal.MostrarPerfiles = function () {
            $.ajax({
                type: 'GET',
                url: APIREST + "perfil",
                dataType: "json",
                data: {},
                async: true
            })
                .done(function (resultado) {
                console.log(resultado);
                if (resultado.exito == false) {
                    var alert = ArmarAlert(resultado.mensaje, "danger");
                    $('#alertPrincipal').html(alert);
                }
                else {
                    console.log(resultado.dato);
                    var datos = JSON.parse(resultado.dato);
                    $('#tablePerfiles').html(Principal.CrearListadoPerfiles(datos));
                    $('[data-action="eliminar"]').on('click', function (e) {
                        var id_perfil_string = $(this).attr("data-perfil");
                        var id_perfil = parseInt(id_perfil_string, 10);
                        var resultado = window.confirm('Estas seguro de que desea eliminar el usuario (id = ' + id_perfil + ')?');
                        if (resultado === true) {
                            Principal.DeletePerfil(id_perfil);
                        }
                        else {
                            window.alert('Operacion cancelada');
                        }
                    });
                    $('[data-action="modificar"]').on('click', function (e) {
                        var obj_perfil = $(this).attr("data-perfil");
                        var resultado = window.confirm('Estas seguro de que desea eliminar el usuario (id = ' + obj_perfil.id + ')?');
                        if (resultado === true) {
                            Principal.ModificarPerfil(obj_perfil);
                        }
                        else {
                            window.alert('Operacion cancelada');
                        }
                    });
                }
            })
                .fail(function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });
        };
        Principal.CrearListadoPerfiles = function (datos) {
            var cabecera = "\n            <tr>\n                <th>Descripcion</th>\n                <th>Estado</th>\n                <th>Borrar</th>\n                <th>Modificar</th>\n            </tr>";
            var datosPerfiles = "";
            for (var _i = 0, datos_2 = datos; _i < datos_2.length; _i++) {
                var datoPerfil = datos_2[_i];
                datosPerfiles +=
                    "<tr>\n                    <td>" + datoPerfil.descripcion + "</td>\n                    <td>" + datoPerfil.estado + "</td>\n                    <td><button class=\"btn-danger\" data-perfil=\"" + datoPerfil.id + "\" data-action='eliminar'>Borrar</button></td>\n                    <td><button class=\"btn-info\" data-perfil=\"" + datoPerfil + "\" data-action=\"modificar\">Modificar</button></td>\n                </tr>";
            }
            var table = '<table class="table table-striped">' + cabecera + datosPerfiles + '</table>';
            return table;
        };
        Principal.DeletePerfil = function (id_perfil) {
            var data = { "id_perfil": id_perfil };
            var token = localStorage.getItem("jwt");
            $.ajax({
                type: 'DELETE',
                url: APIREST + "perfiles/",
                dataType: "json",
                data: JSON.stringify(data),
                headers: { "token": token, "content-type": "application/json" },
                async: true
            })
                .done(function (resultado) {
                console.log(resultado);
                if (resultado.exito == false) {
                    var alert = ArmarAlert(resultado.mensaje, "warning");
                    $('#alertPrincipal').html(alert);
                }
                else {
                    Principal.MostrarPerfiles();
                }
            })
                .fail(function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });
        };
        Principal.ModificarPerfil = function (datosModificar) {
            var token = localStorage.getItem("jwt");
            $.ajax({
                type: 'PUT',
                url: APIREST + "perfiles/",
                dataType: "json",
                data: JSON.stringify(datosModificar),
                headers: { "token": token, "content-type": "application/json" },
                async: true
            })
                .done(function (resultado) {
                console.log(resultado);
                if (resultado.exito == false) {
                    var alert = ArmarAlert(resultado.mensaje, "warning");
                    $('#alertPrincipal').html(alert);
                }
                else {
                    Principal.MostrarPerfiles();
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