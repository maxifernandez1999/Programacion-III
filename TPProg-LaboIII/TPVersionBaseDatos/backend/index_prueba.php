<?php
    include('validarSesion.php');
    include('Persona.php');
    include('Empleado.php');
    include('Fabrica.php');
    
    $objEmpleado1 = new Empleado('Maxi','Hernandez',42564561,'m',12025,5000,'noche');
    $objEmpleado2 = new Empleado('Pablo','Hernandez',441565636,'m',12525,6000,'noche');
    $objEmpleado3 = new Empleado('Miriam','Slivka',30202020,'f',15242,7000,'tarde');
    $objEmpleado4 = new Empleado('Maxi','Hernandez',42564561,'m',12025,5000,'noche');
    $arrayIdiomas = array("Ingles","Frances","Aleman");
    
    $objFabrica = new Fabrica('Elpepe');
    $objFabrica->InsertEmpleado($objEmpleado1);
    $objFabrica->InsertEmpleado($objEmpleado2);
    $objFabrica->InsertEmpleado($objEmpleado3);
    $objFabrica->InsertEmpleado($objEmpleado4);
    $objFabrica->DeleteEmpleado($objEmpleado2);

    echo $sueldo;

    echo "<br><a href='cerrarSesion.php'>desloguearse</a>"

    

?>