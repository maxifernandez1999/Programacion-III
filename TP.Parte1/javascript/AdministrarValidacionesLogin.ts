function AdministrarValidacionesLogin(){
    if(!ValidarCamposVacios((<HTMLInputElement>document.getElementById('txtApellido')).value)){
        // alert('El campo APELLIDO se encuentra vacio, por favor ingrese un apellido');
        let elementoSpan:HTMLElement = (<HTMLInputElement>document.getElementById('spanApellido'));
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        return false;
    }
    if(!ValidarCamposVacios((<HTMLInputElement>document.getElementById('txtDni')).value)){
        // alert('El campo DNI se encuentra vacio, por favor ingrese un Dni');
        let elementoSpan:HTMLElement = (<HTMLInputElement>document.getElementById('spanDni'));
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
            
        }
        return false;
    }
    

    var numeroValidarDni:number = parseInt((<HTMLInputElement>document.getElementById('txtDni')).value);
    var numeroMinDni:number= parseInt((<HTMLInputElement>document.getElementById('txtDni')).min);
    var numeroMaxDni:number = parseInt((<HTMLInputElement>document.getElementById('txtDni')).max);
    if(!ValidarRangoNumerico(numeroValidarDni,numeroMinDni,numeroMaxDni)){
        let elementoSpan:HTMLElement = (<HTMLInputElement>document.getElementById('spanDni'));
        elementoSpan.style.display = 'block';
        return false;
        
    }
}