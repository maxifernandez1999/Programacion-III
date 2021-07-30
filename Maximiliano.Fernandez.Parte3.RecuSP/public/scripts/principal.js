"use strict";
/// <reference path="../node_modules/@types/jquery/index.d.ts" />
$(function () {
    $("#btnUsuarios").on("click", Manager.Principal.MostrarUsuarios);
    $("#btnPerfiles").on("click", Manager.Principal.MostrarPerfiles);
    $("#btnDeleteAuto").on("click", Manager.Principal.DeletePerfil);
    $("#filter").on("click", Manager.Principal.FiltrarPerfiles);
    $("#agregarPerfil").on("click", Manager.Principal.BtnOK);
    $("#deleteUser").on("click", Manager.Principal.DeleteUsuario);
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
                    "<tr>\n                    <td>" + datoUser.id + "</td>\n                    <td>" + datoUser.correo + "</td>\n                    <td>" + datoUser.clave + "</td>\n                    <td>" + datoUser.nombre + "</td>\n                    <td>" + datoUser.apellido + "</td>\n                    <td><img src=\"../../src/fotos/" + datoUser.foto + "\" alt=\"\" width=\"50px\" height=\"50px\"></td>\n                    <td>" + datoUser.id_perfil + "</td>\n                </tr>";
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
                        var id_perfil_modificar = $(this).attr("data-perfil");
                        $('#buttonOK').on('click', function (e) {
                            var datosModificar = { "descripcion": $('#descripcionModificar').val(), "estado": parseInt($('#estadoModificar').val(), 10) };
                            var resultado = window.confirm('Estas seguro de que desea eliminar el usuario (id = ' + id_perfil_modificar + ')?');
                            if (resultado === true) {
                                Principal.ModificarPerfil(id_perfil_modificar, datosModificar);
                            }
                            else {
                                window.alert('Operacion cancelada');
                            }
                        });
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
                    "<tr>\n                    <td>" + datoPerfil.descripcion + "</td>\n                    <td>" + datoPerfil.estado + "</td>\n                    <td><button class=\"btn-danger\" data-perfil=\"" + datoPerfil.id + "\" data-action='eliminar'>Borrar</button></td>\n                    <td><button type=\"button\" class=\"btn-info\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\" data-action=\"modificar\" data-perfil=\"" + datoPerfil.id + "\">\n                    Modificar</button></td>\n                </tr>";
            }
            // <td><button class="btn-info" data-perfil="${datoPerfil}" data-action="modificar">Modificar</button></td>
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
                if (resultado.exito == false || resultado.status == 403) {
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
        Principal.ModificarPerfil = function (id_perfil_modificar, datosModificar) {
            var token = localStorage.getItem("jwt");
            var json = { "id_perfil": id_perfil_modificar, "perfil": { "descripcion": datosModificar.descripcion, "estado": datosModificar.estado } };
            $.ajax({
                type: 'PUT',
                url: APIREST + "perfiles/",
                dataType: "json",
                data: JSON.stringify(json),
                headers: { "token": token, "content-type": "application/json" },
                async: true
            })
                .done(function (resultado) {
                console.log(resultado);
                if (resultado.exito == false || resultado.status == 403) {
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
        Principal.FiltrarPerfiles = function () {
            $.ajax({
                type: 'GET',
                url: APIREST + "perfil",
                dataType: "json",
                data: {},
                async: true
            })
                .done(function (resultado) {
                var datosFiltrados = Principal.Filter(JSON.parse(resultado.dato));
                $('#tablePerfiles').html(Principal.CrearListadoPerfiles(datosFiltrados));
            })
                .fail(function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });
        };
        Principal.Filter = function (perfiles) {
            var activos = perfiles.filter(function (perfil) { return perfil.estado === "1"; });
            return activos;
        };
        Principal.Map = function (usuarios) {
            var nombres_fotos = usuarios.map(function (usuario) { return usuario.nombre && usuario.foto; });
            return nombres_fotos;
        };
        Principal.Reduce = function (usuarios) {
            var totalStock = usuarios.reduce(function (anterior, actual) { return anterior + actual.stock; }, 0);
            return totalStock;
        };
        Principal.ObtenerDatosPerfil = function () {
            var descripcion = $('#descripcionAlta').val();
            var estado = $('#estadoAlta').val();
            var jsonPerfil = {};
            jsonPerfil.descripcion = descripcion;
            jsonPerfil.estado = parseInt(estado, 10);
            return JSON.stringify(jsonPerfil);
        };
        Principal.BtnOK = function () {
            $('#btnOKAlta').on('click', function (e) {
                var datosModificar = Principal.ObtenerDatosPerfil();
                var resultado = window.confirm('Estas seguro de que desea agregar el usuario?');
                if (resultado === true) {
                    e.preventDefault();
                    Principal.AgregarPerfil(datosModificar);
                }
                else {
                    window.alert('Operacion cancelada');
                }
            });
        };
        Principal.AgregarPerfil = function (data) {
            $.ajax({
                type: 'POST',
                url: APIREST,
                dataType: "json",
                data: "perfil=" + data,
                async: true
            })
                .done(function (resultado) {
                console.log(resultado);
                if (resultado.exito == false || resultado.status == 403) {
                    var alert = ArmarAlert(resultado.mensaje, "danger");
                    $('#alertPrincipal').html(alert);
                }
                else {
                    var alert = ArmarAlert(resultado.mensaje, "success");
                    $('#alertPrincipal').html(alert);
                }
            })
                .fail(function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });
        };
        Principal.DeleteUsuario = function (id_usuario) {
            var data = { "id_usuario": id_usuario };
            var token = localStorage.getItem("jwt");
            $.ajax({
                type: 'DELETE',
                url: APIREST + "usuarios/",
                dataType: "json",
                data: JSON.stringify(data),
                headers: { "token": token, "content-type": "application/json" },
                async: true
            })
                .done(function (resultado) {
                console.log(resultado);
                if (resultado.exito == false || resultado.status == 403) {
                    var alert = ArmarAlert(resultado.mensaje, "warning");
                    $('#alertPrincipal').html(alert);
                }
                else {
                    Principal.MostrarUsuarios();
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