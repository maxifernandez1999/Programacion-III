<?php   
    /**Escribir un programa que use la variable $operador que pueda almacenar los símbolos
    matemáticos: ‘+’, ‘-’, ‘/’ y ‘*’; y definir dos variables enteras $op1 y $op2. De acuerdo al
    símbolo que tenga la variable $operador, deberá realizarse la operación indicada y mostrarse el
    resultado por pantalla. */

    $operador = '/';

    $op1 = 5;
    $op2 = 10;

    switch ($operador) {
        case '+':
            $resultado = $op1 + $op2;
            echo $resultado;
        break;
        case '-':
            $resultado = $op1 - $op2;
            echo $resultado;
        break;
        case '/':
            $resultado = $op1 / $op2;
            echo $resultado;
        break;
        case '*':
            $resultado = $op1 * $op2;
            echo $resultado;
        break;
        default:
            # code...
            break;
    }

?>