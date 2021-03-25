<?php
    /**Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
    Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el
    salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números utilizando
    las estructuras while y foreach. */
    $vec = array();
    $num = 1;
    do {
        if($num % 2 == 1){
            array_push($vec,$num);
        }
        $num++;
    } while (count($vec) < 10);

    for ($i=0; $i < count($vec) ; $i++) { 
        echo $vec[$i].'<br>';
    }
    echo '<br>';
    $o = 0;
    while ($o < count($vec)) {
        echo $vec[$o].'<br>';
        $o++;
    }
    echo '<br>';
    foreach ($vec as $value) {
        echo $value.'<br>';
    }
    //var_dump($vec);
?>