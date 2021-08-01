<?php
    /*Realizar un programa que en base al valor numérico de la variable $num, pueda mostrarse por
    pantalla, el nombre del número que tenga dentro escrito con palabras, para los números entre
    el 20 y el 60.
    Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”.*/

    $num = 15;
    if ($num >= 20 && $num <=60) {
        $numCast = (string)$num;
        $num1 = strlen($numCast);
        if ($numCast[0] == 2) {
            $nameNum = numCast($numCast[1]);
                if ($numCast[1] == 0) {
                    echo 'veinte';
                }else{
                    echo 'veinti '.$nameNum;
                }
            }
        if ($numCast[0] == 3) {
            $nameNum = numCast($numCast[1]);
                if ($numCast[1] == 0) {
                    echo 'treinta';
                }else{
                    echo 'treinta y '.$nameNum;
                }
            }
        if ($numCast[0] == 4) {
            $nameNum = numCast($numCast[1]);
                if ($numCast[1] == 0) {
                    echo 'cuarenta';
                }else{
                    echo 'cuarenta y '.$nameNum;
                }
            }
            if ($numCast[0] == 5) {
                $nameNum = numCast($numCast[1]);
                    if ($numCast[1] == 0) {
                        echo 'cincuenta';
                    }else{
                         echo 'cincuenta y '.$nameNum;
                    }
                }
            if ($numCast[0] == 6) {
                echo 'sesenta';
            }
        }else {
            echo 'El numero no esta dentro del rango';
        }
        function numCast($cast){
            $nameNum = 0;
            switch ($cast) {
                case '0':
                    $nameNum = 'veinte';
                break;
                case '1':
                    $nameNum = 'uno';
                break;
                case '2':
                    $nameNum = 'dos';
                break;
                case '3':
                    $nameNum = 'tres';
                break;
                case '4':
                    $nameNum = 'cuatro';
                break;
                case '5':
                    $nameNum = 'cinco';
                break;
                case '6':
                    $nameNum = 'seis';
                break;
                case '7':
                    $nameNum = 'siete';
                break;
                case '8':
                    $nameNum = 'ocho';
                break;
                case '9':
                    $nameNum = 'nueve';
                break;
                
                default:
                    # code...
                break;
            }
            return $nameNum;
        }
    

    
?>