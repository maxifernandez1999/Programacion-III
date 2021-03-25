<?php
    /*Confeccionar un programa que sume todos los números enteros desde 1 mientras la suma no
    supere a 1000. Mostrar los números sumados y al finalizar el proceso indicar cuantos números
    se sumaron. */

    $numero1 = 1;
    $numero2 = 1;
    $contador = 0;

    do {
        $numero2++;
        $resultado = $numero1 + $numero2;
        echo $numero1.'+ '.$numero2.'= '.$resultado;
        echo '<br>';
        $numero1++;
        
        $contador++; 

    } while ($resultado < 1000);

    echo 'se sumaron '.$contador.' numeros';
?>