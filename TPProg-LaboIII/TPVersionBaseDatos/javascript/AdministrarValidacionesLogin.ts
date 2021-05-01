function AdministrarValidacionesLogin(event:Event){
    var retorno:boolean = true;
    if(!ValidarCamposVacios((<HTMLInputElement>document.getElementById('txtApellido')).value)){
        let elementoSpan:HTMLElement = (<HTMLInputElement>document.getElementById('spanApellido'));
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
        }
        retorno = false;
    }
    if(!ValidarCamposVacios((<HTMLInputElement>document.getElementById('txtDni')).value)){
        let elementoSpan:HTMLElement = (<HTMLInputElement>document.getElementById('spanDni'));
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
            
        }
        retorno = false;
    }
    

    var numeroValidarDni:number = parseInt((<HTMLInputElement>document.getElementById('txtDni')).value);
    var numeroMinDni:number= parseInt((<HTMLInputElement>document.getElementById('txtDni')).min);
    var numeroMaxDni:number = parseInt((<HTMLInputElement>document.getElementById('txtDni')).max);
    if(!ValidarRangoNumerico(numeroValidarDni,numeroMinDni,numeroMaxDni)){
        let elementoSpan:HTMLElement = (<HTMLInputElement>document.getElementById('spanDni'));
        if (elementoSpan.style.display == 'none') {
            elementoSpan.style.display = 'block';
            
        }
        retorno = false;
        
    }
    if (retorno == false) {
        event.preventDefault();
    }
}