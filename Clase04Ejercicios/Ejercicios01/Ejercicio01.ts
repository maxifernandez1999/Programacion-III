//CREO UNA INSTANCIA DE XMLHTTPREQUEST

    function Ejercicio01(){
        let xhttp : XMLHttpRequest = new XMLHttpRequest();
        var value:number = parseInt((<HTMLInputElement>document.getElementById('number')).value);
        if (value > 0) {
            xhttp.open("POST", "Ejercicio01.php", true);

            
            xhttp.setRequestHeader("content-type","application/x-www-form-urlencoded");
            xhttp.send("valor="+value.toString());
            xhttp.onreadystatechange = () => {
        
            console.log(xhttp.readyState + " - " + xhttp.status);
        
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    (<HTMLInputElement>document.getElementById("text")).value = xhttp.responseText;
                }
            };
        }
    
}