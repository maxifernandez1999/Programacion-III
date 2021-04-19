<?php
    include('backend/validarSesion.php');
    include('Persona.php');
    include('Empleado.php');
    include('Fabrica.php');
    
    $objEmpleado1 = new Empleado('Maxi','Hernandez',42564561,'m',12025,5000,'noche');
    $objEmpleado2 = new Empleado('Pablo','Hernandez',441565636,'m',12525,6000,'noche');
    $objEmpleado3 = new Empleado('Miriam','Slivka',30202020,'f',15242,7000,'tarde');
    $objEmpleado4 = new Empleado('Maxi','Hernandez',42564561,'m',12025,5000,'noche');
    $arrayIdiomas = array("Ingles","Frances","Aleman");
    //$objEmpleado1->Hablar($arrayIdiomas);
    //echo '<br>';
    //$string = $objEmpleado1->ToString();
    //echo $string;

    
    $objFabrica = new Fabrica('Elpepe');
    $objFabrica->AgregarEmpleado($objEmpleado1);
    $objFabrica->AgregarEmpleado($objEmpleado2);
    $objFabrica->AgregarEmpleado($objEmpleado3);
    $objFabrica->AgregarEmpleado($objEmpleado4);
    $objFabrica->EliminarEmpleado($objEmpleado2);
    $cadenaFabrica = $objFabrica->ToString();

    $sueldo = $objFabrica->CalcularSueldos();

    echo $sueldo;

    echo "<br><a href='cerrarSesion.php'>desloguearse</a>"
    //echo $cadenaFabrica;

    

?>