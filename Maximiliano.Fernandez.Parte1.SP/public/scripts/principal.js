"use strict";
/// <reference path="../node_modules/@types/jquery/index.d.ts" />
$(function () {
    $("#btnUsuarios").on("click", Manager.Principal.MostrarUsuarios);
    $("#btnAutos").on("click", Manager.Principal.MostrarAutos);
    $("#btnDeleteAuto").on("click", Manager.Principal.DeleteAuto);
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
                    $('[data-action="eliminar"]').on('click', function (e) {
                        var id_auto_string = $(this).attr("data-auto");
                        var id_auto = parseInt(id_auto_string, 10);
                        Principal.DeleteAuto(id_auto);
                    });
                    // $('[data-action="modificar"]').on('click', function (e) {
                    //     let obj_auto_string = $(this).attr("data-auto");
                    //     let obj_auto = JSON.parse(obj_auto_string);
                    // });
                }
            })
                .fail(function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });
        };
        Principal.CrearListadoAutos = function (datos) {
            var cabecera = "\n            <tr>\n                <th>Marca</th>\n                <th>Color</th>\n                <th>Modelo</th>\n                <th>Precio</th>\n                <th>Borrar</th>\n                <th>Modificar</th>\n            </tr>";
            var datoAutos = "";
            for (var _i = 0, datos_2 = datos; _i < datos_2.length; _i++) {
                var datoAuto = datos_2[_i];
                datoAutos +=
                    "<tr>\n                    <td>" + datoAuto.marca + "</td>\n                    <td>" + datoAuto.color + "</td>\n                    <td>" + datoAuto.modelo + "</td>\n                    <td>" + datoAuto.precio + "</td>\n                    <td><button class=\"btn-danger\" data-auto=\"" + datoAuto.id + "\" data-action='eliminar'>Borrar</button></td>\n                    <td><button class=\"btn-info\">Modificar</button></td>\n                </tr>";
            }
            var table = '<table class="table table-striped">' + cabecera + datoAutos + '</table>';
            return table;
        };
        Principal.DeleteAuto = function (id_auto) {
            var data = { "id_auto": id_auto };
            var resultado = window.confirm('Estas seguro de que desea eliminar el usuario (id = ' + id_auto + ')?');
            var token = localStorage.getItem("jwt");
            var form = new FormData();
            form.append("id_auto", id_auto);
            if (resultado === true) {
                $.ajax({
                    type: 'DELETE',
                    url: APIREST,
                    dataType: "json",
                    data: form,
                    headers: { "token": token, "content-type": "application/json" },
                    async: true,
                    processData: false,
                    contentType: false
                })
                    .done(function (resultado) {
                    console.log(resultado);
                    if (resultado.exito == false || resultado.exito == undefined && resultado.mensaje == "No propietario") {
                        var alert = ArmarAlert(resultado.mensaje, "warning");
                        $('#danger').html(alert);
                    }
                    else if (resultado.exito == false || resultado.exito == undefined && resultado.mensaje == "jwt invalido") {
                        $(location).attr('href', APIREST + "front-end");
                    }
                    else {
                        Principal.MostrarAutos();
                    }
                })
                    .fail(function (jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
                });
            }
            else {
                window.alert('Operacion cancelada');
            }
        };
        return Principal;
    }());
    Manager.Principal = Principal;
})(Manager || (Manager = {}));
//# sourceMappingURL=principal.js.map