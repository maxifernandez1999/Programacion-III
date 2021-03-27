<?php
    // En testAuto.php:
    //  Crear dos objetos “Auto” de la misma marca y distinto color.
    //  Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
    //  Crear un objeto “Auto” utilizando la sobrecarga restante.
    //  Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500 al
    // atributo precio.
    //  Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el resultado
    // obtenido.
    //  Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o no.
    //  Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3, 5)
    include('Auto.php');
    $objAuto0 = new Auto('toyota','negro');
    $objAuto1 = new Auto('toyota','blanco');

    $objAuto2 = new Auto('toyota','negro',300);
    $objAuto3 = new Auto('toyota','negro',250);

    $objAuto4 = new Auto('toyota','negro',400,'25/5/2007');

    $objAuto2->AgragarImpuestos(1500);
    $objAuto3->AgragarImpuestos(1500);
    $objAuto4->AgragarImpuestos(1500);

    $valor = Auto::Add($objAuto0,$objAuto1);
    echo $valor;
    $retorno = $objAuto0->Equals($objAuto1);
    if ($retorno == true) {
        echo 'son iguales';
    }else{
        echo 'no son iguales';
    }
    Auto::MostrarAuto($objAuto0);
    Auto::MostrarAuto($objAuto2);
    Auto::MostrarAuto($objAuto4);



    



?>