<?php
    session_start();
    require_once './Fabrica.php';
    require_once '../PHPFunctions/tablaHTML.php';
    require_once __DIR__ . '/../vendor/autoload.php';
    header('content-type:application/pdf');

    $objFabrica = new Fabrica("123");
    $consulta = $objFabrica->SelectEmpleados();
    $TD = "";
    while($user = $consulta->fetch(PDO::FETCH_OBJ)){
        $TD .= GenerarTD($user->nombre,$user->apellido,$user->dni,$user->sexo,$user->legajo,$user->sueldo,$user->turno,$user->pathfoto);
    }
    $tablaHTML = GenerarTABLA($TD);
    
    $mpdf = new \Mpdf\Mpdf(['orientation' => 'P',
                        'pagenumPrefix' => 'Pagina nro. ',
                        'nbpgPrefix' => ' de ',
                        'nbpgSuffix' => ' páginas'
                        ]);

    $mpdf->SetProtection(array(),$_SESSION['DNIEmpleado']);
    $mpdf->SetHeader('Maximiliano Fernandez||{PAGENO}{nbpg}');
    $mpdf->setFooter('https://mfernandeztp.000webhostapp.com/');
    $mpdf->WriteHTML($tablaHTML);
    $mpdf->Output();

    
?>
