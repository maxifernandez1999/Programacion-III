<?php
    /*Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
    función rand). Mediante una estructura condicional, determinar si el promedio de los números
    son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
    resultado.*/
    $vec = array(rand(1,9),rand(1,9),rand(1,9),rand(1,9),rand(1,9));
    var_dump($vec);
    $promedio = ($vec[0] + $vec[1] + $vec[2] + $vec[3] + $vec[4]) / count($vec);
    if ($promedio > 6) {
        echo 'el promedio es: '.$promedio.' y es mayor a 6';
    }else if ($promedio < 6) {
        echo 'el promedio es: '.$promedio.' y es menor a 6';
    }else {
        echo 'el promedio es: '.$promedio.' y es igual a 6';
    }

?>