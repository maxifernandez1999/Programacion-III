"use strict";
//CREO UNA INSTANCIA DE XMLHTTPREQUEST
function Ejercicio01() {
    var xhttp = new XMLHttpRequest();
    var value = parseInt(document.getElementById('number').value);
    if (value > 0) {
        xhttp.open("POST", "Ejercicio01.php", true);
        xhttp.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        xhttp.send("valor=" + value.toString());
        xhttp.onreadystatechange = function () {
            console.log(xhttp.readyState + " - " + xhttp.status);
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("text").value = xhttp.responseText;
            }
        };
    }
}
//# sourceMappingURL=Ejercicio01.js.map