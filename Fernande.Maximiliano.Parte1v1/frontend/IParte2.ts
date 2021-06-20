interface IParte2{
    EliminarProducto(jsonEliminar:any):any;
    ModificarProducto():any;


}

MostrarInfoCookie. Se realizará una petición (por AJAX) a “./BACKEND/MostrarCookie.php” que recibe por GET 
// el nombre y el origen del producto y se verificará si existe una cookie con el mismo nombre, de ser así, retornará un JSON que 
// contendrá: éxito(bool) y mensaje(string), dónde se mostrará el contenido de la cookie. Caso contrario, false y el mensaje indicando lo 
// acontecido.
// Informar por consola el mensaje recibido y mostrar el mensaje en la página (div id='divInfo').

        // public MostrarInfoCookie(){
        //     let especialidad:string = (<HTMLInputElement>document.getElementById("especialidad")).value;
        //     let email:string = (<HTMLInputElement>document.getElementById("email")).value;
        //     this.ajax.Get("./backend/MostrarCookie.php",(resultado:string)=>{
        //         let json:any = JSON.parse(resultado);
        //         console.log(json.mensaje);
        //         //(<HTMLDivElement>document.getElementById("divInfo")).innerHTML = json[0].mensaje;
        //     },`especialidad=${especialidad}&email=${email}`,this.Fail);
        // }
//         AgregarProductoSinFoto. Obtiene el código de barra, el nombre, el origen y el precio desde la página 
// producto.html, y se enviará (por AJAX) hacia “./BACKEND/AgregarProductoSinFoto.php” que recibe por POST el 
// parámetro producto_json (codigoBarra, nombre, origen y precio), en formato de cadena JSON. Se invocará al método Agregar. 
// Se retornará un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.
// Informar por consola y alert el mensaje recibido.