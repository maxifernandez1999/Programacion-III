<?php

    /**Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden de las letras del Array.
    Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”. */
    
    $vec = array('H','O','L','A');
    function InvertirLetras($vec)
    {
        $arrayL= count($vec);
        $vecInvertido = array();
        $j = 0;
        for ($i = $arrayL-1 ; $i >= 0; $i--) { 
            $vecInvertido[$j] = $vec[$i];
            $j++;
        }
        echo var_dump($vecInvertido);
    }
    InvertirLetras($vec);

?>