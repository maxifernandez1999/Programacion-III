var Ajax = /** @class */ (function () {
    function Ajax() {
        var _this = this;
        this.Get = function (ruta, success, params, asincronic, error) {
            if (params === void 0) { params = ""; }
            var parametros = params.length > 0 ? params : "";
            ruta = params.length > 0 ? ruta + "?" + parametros : ruta;
            _this._xhr.open('GET', ruta, asincronic);
            _this._xhr.send();
            _this._xhr.onreadystatechange = function () {
                if (_this._xhr.readyState === Ajax.DONE) {
                    if (_this._xhr.status === Ajax.OK) {
                        success(_this._xhr.responseText);
                    }
                    else {
                        if (error !== undefined) {
                            error(_this._xhr.status);
                        }
                    }
                }
            };
        };
        this.Post = function (ruta, success, params, archivo, asincronic, error) {
            if (params === void 0) { params = ""; }
            var parametros = params.length > 0 ? params : "";
            _this._xhr.open('POST', ruta, asincronic);
            //if (fileID !== undefined) {
            var form = new FormData();
            form.append('archivo', archivo.files[0]);
            var array = parametros.split("?");
            for (var index = 0; index < array.length; index++) {
                var newArray = array[index].split("=");
                form.append(newArray[0], newArray[1]);
            }
            _this._xhr.setRequestHeader("enctype", "multipart/form-data");
            //this._xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
            _this._xhr.send(form);
            //}
            // this._xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
            _this._xhr.onreadystatechange = function () {
                if (_this._xhr.readyState === Ajax.DONE) {
                    if (_this._xhr.status === Ajax.OK) {
                        success(_this._xhr.responseText);
                    }
                    else {
                        if (error !== undefined) {
                            error(_this._xhr.status);
                        }
                    }
                }
            };
        };
        this._xhr = new XMLHttpRequest();
        Ajax.DONE = 4;
        Ajax.OK = 200;
    }
    return Ajax;
}());
//     public SubirFoto = (ruta: string, success: Function, error?: Function):void => {
//         //RECUPERO LA IMAGEN SELECCIONADA POR EL USUARIO
//         //FUNCION CALLBACK
//         this._xhr.onreadystatechange = ():void => {
//             if (this._xhr.readyState === Ajax.DONE) {
//                 if (this._xhr.status === Ajax.OK) {
//                     success(this._xhr.responseText);
//                 } else {
//                     if (error !== undefined){
//                         error(this._xhr.status);
//                     }
//                 }
//             }
//         };
//     }
// }
