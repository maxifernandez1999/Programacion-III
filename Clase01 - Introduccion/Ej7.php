<?php
    /*Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
    distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
    año es. Utilizar una estructura selec++tiva múltiple.*/

    $fecha = Date('d/m/y=h:i:s'); //no es la hora del windows sino del servidor
    echo $fecha;
    
?>