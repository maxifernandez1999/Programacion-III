// Aplicación No 6 (Verificar nombre de usuario)
// Realizar una aplicación web que verifique la disponibilidad de un nombre de usuario. Para ello
// crear una página sencilla, que posea un <input type=”text”> para ingresar el nombre de
// usuario y un <input type=”button”> (con la leyenda: Verificar) que se comunicará (utilizando
// AJAX) al servidor de nombres (página comprobarDisponibilad.php) y obtendrá como respuesta
// un “SI” o un “NO”, dependiendo si ese nombre de usuario está disponible o no.
// Para simular la búsqueda sobre la base de datos de usuarios, en comprobarDisponibilidad.php
// se realizará lo siguiente:
// Generara un falso retardo ocasionado por la búsqueda y el tráfico de la red de entre 0 y 6
// segundos (utilizar función rand() y la función sleep(). Buscar información). Además, retornará
// aleatoriamente, “SI” o “NO”. A partir de la respuesta del servidor, mostrar un mensaje al
// usuario indicando el resultado de la comprobación.
function Comunicacion(){
    var xhttp : XMLHttpRequest  = new XMLHttpRequest();
    xhttp.open('GET','comprobarDisponibilidad.php',true);
    xhttp.send();
    xhttp.onreadystatechange = () => {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            alert(xhttp.responseText);
        }
    };

}