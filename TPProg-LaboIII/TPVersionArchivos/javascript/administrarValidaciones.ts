function AdministrarModificar(dni:string){
    (<HTMLInputElement>document.getElementById('txtHidden')).value = dni;
    (<HTMLFormElement>document.getElementById("FormModificar")).submit();
}
//FUNCION QUE ADMINISTRA LAS VALIDACIONES
function AdministrarValidaciones():boolean{
    var checked:boolean = true;
    //validaciones campos vacios

    if(!ValidarCamposVacios((<HTMLInputElement>document.getElementById('archivo')).value)){
        let elementoSpan:HTMLElement = (<HTMLInputElement>document.getElementById('spanFile'));
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        checked = false;
    }
    if(!ValidarCamposVacios((<HTMLInputElement>document.getElementById('txtDni')).value)){
        let elementoSpan:HTMLElement = (<HTMLInputElement>document.getElementById('spanDni'));
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        checked = false;
    }
    if(!ValidarCamposVacios((<HTMLInputElement>document.getElementById('Nombre')).value)){
        
        let elementoSpan:HTMLElement = (<HTMLInputElement>document.getElementById('spanNombre'));
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        checked = false;
    }
    if(!ValidarCamposVacios((<HTMLInputElement>document.getElementById('apellido')).value)){
        let elementoSpan:HTMLElement = (<HTMLInputElement>document.getElementById('spanApellido'));
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        checked = false;
    }
    if(!ValidarCamposVacios((<HTMLInputElement>document.getElementById('txtLegajo')).value)){
        let elementoSpan:HTMLElement = (<HTMLInputElement>document.getElementById('spanLegajo'));
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        checked = false;
    }
    if(!ValidarCamposVacios((<HTMLInputElement>document.getElementById('txtSueldo')).value)){
        let elementoSpan:HTMLElement = (<HTMLInputElement>document.getElementById('spanSueldo'));
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        checked = false;
    }

    //validacion rango numerico
    //DNI
    var numeroValidarDni:number = parseInt((<HTMLInputElement>document.getElementById('txtDni')).value);
    var numeroMinDni:number= parseInt((<HTMLInputElement>document.getElementById('txtDni')).min);
    var numeroMaxDni:number = parseInt((<HTMLInputElement>document.getElementById('txtDni')).max);
    if(!ValidarRangoNumerico(numeroValidarDni,numeroMinDni,numeroMaxDni)){
        let elementoSpan:HTMLElement = (<HTMLInputElement>document.getElementById('spanDni'));
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        checked = false;
    }
    //LEGAJO
    var numeroValidarLegajo:number = parseInt((<HTMLInputElement>document.getElementById('txtLegajo')).value);
    var numeroMinLegajo:number = parseInt((<HTMLInputElement>document.getElementById('txtLegajo')).min);
    var numeroMaxLegajo:number = parseInt((<HTMLInputElement>document.getElementById('txtLegajo')).max);

    if(!ValidarRangoNumerico(numeroValidarLegajo,numeroMinLegajo,numeroMaxLegajo)){
        let elementoSpan:HTMLElement = (<HTMLInputElement>document.getElementById('spanLegajo'));
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        checked = false;
    }
    //SUELDO
    var numeroValidarSueldo:number = parseInt((<HTMLInputElement>document.getElementById('txtSueldo')).value);
    var numeroMinSueldo:number = parseInt((<HTMLInputElement>document.getElementById('txtSueldo')).min);
    var numeroMaxSueldo:number = ObtenerSueldoMaximo(ObtenerTurnoSeleccionado());

    if(!ValidarRangoNumerico(numeroValidarSueldo,numeroMinSueldo,numeroMaxSueldo)){
        let elementoSpan:HTMLElement = (<HTMLInputElement>document.getElementById('spanLegajo'));
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        checked = false;
    }

    //validar combobox
    var valorCombo:string = (<HTMLInputElement>document.getElementById('cboSexo')).value;
    if(!ValidarCombo(valorCombo,'---')){
        let elementoSpan:HTMLElement = (<HTMLInputElement>document.getElementById('spanCboSexo'));
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        checked = false;
    }
    return checked;
}
    


