<?php
    /*Crear una función llamada EsPar que reciba un valor entero como parámetro y devuelva TRUE sieste número es par ó FALSE si es impar.Reutilizando el código anterior, crear la función EsImpar. */

    function EsPar($entero){
        if ($entero % 2 == 0) {
            return true;
            echo 'ok';
        }else{
            return false;
        }
    }

    function EsImpar($entero){
        if(!EsPar($entero)){
            return true;
        }else{
            return false;
        }
    }

    $valorPar = EsPar('36');
    $valorImpar = EsImpar('3');

    echo $valorPar. '<br>';
    echo $valorImpar;
?>


