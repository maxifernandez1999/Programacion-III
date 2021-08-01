<?php
    /**Mostrar por pantalla las primeras 4 potencias de los números del uno 1 al 4 (hacer una función que las calcule invocando la función pow). */

    function CalcularPotencias()
    {
        $u = 1;
        for ($i=1; $i <= 4; $i++) { 
            echo 'Potencias de: '.$i. '<br>';
            for ($u=1; $u < 4 ; $u++) { 
                $potencia = pow($i,$u);
                echo $potencia. '<br>';
            }
            
        }
        
    }
    CalcularPotencias();
?>