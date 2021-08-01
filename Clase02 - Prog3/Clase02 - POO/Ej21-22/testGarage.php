<?php

    include('Garage.php');
    include('Auto.php');
    $objGarage = new Garage('Elepepe');

    $objAuto1 = new Auto('toyota','negro');
    $objAuto2 = new Auto('fiat','blanco');

    $objAuto3 = new Auto('nissan','negro');
    $objAuto4 = new Auto('volkswagen','negro');

    $objGarage->Add($objAuto1);
    $objGarage->Add($objAuto2);
    $objGarage->Add($objAuto3);
    $objGarage->Add($objAuto4);

    $objGarage->Remove($objAuto4);
    $objGarage->MostrarGarage();


