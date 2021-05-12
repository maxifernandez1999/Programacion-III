<?php
// Agregar un botón/link que permita visualizar el listado de empleados en un archivo .pdf.
// El archivo tendrá:
// *-Encabezado (apellido y nombre del alumno y número de página)
// *-Cuerpo (Título del listado, listado completo de los empleados, con su respectiva foto y sin los botones)
// *-Pie de página (url del sitio web)

// El archivo .pdf contendrá clave, la misma será el número de D.N.I. del usuario logueado.

// El TP sólo se evaluará desde el link al host externo, para ello se necesita informar la url del mismo, de ser necesario, dejar nombres de usuarios y contraseñas válidas.
    session_start();
    require_once __DIR__. '/vendor/autoload.php';

    header('content-type:application/pdf');
    
    $mpdf = new \Mpdf\Mpdf(['orientation' => 'P', 
                            'pagenumPrefix' => 'Página nro. ',
                            'pagenumSuffix' => ' - ',
                            'nbpgPrefix' => ' de ',
                            'nbpgSuffix' => ' páginas']);
    
    $dni = $_SESSION['DNIEmpleado'];
    $mpdf->SetProtection(array(),$dni);
    $mpdf->SetHeader('Maximiliano Fernandez||{PAGENO}{nbpg}');


    include_once('Persona.php');
    include_once('Empleado.php');
    include_once('Fabrica.php');
    $objFabrica = new Fabrica("xd");
    $consulta = $objFabrica->SelectEmpleados();
    $encabezado = '<tr><th>NOMBRE<th><th>APELLIDO<th><th>DNI<th><th>SEXO<th><th>LEGAJO<th><th>SUELDO<th><th>TURNO<th><th>FOTO<th></tr>';
    while($value = $consulta->fetch()){
        $objEmpleado = new Empleado($value["nombre"],$value["apellido"],$value["dni"],$value["sexo"],$value["legajo"],$value["sueldo"],$value["turno"],$value["pathfoto"]);  
        // $legajo = $objEmpleado->GetLegajo();
        // $pathFoto = $objEmpleado->GetPathFoto();
        // $objetoDni = $objEmpleado->GetDni();
        // $arrayEmpleados = $objFabrica->GetEmpleados();
        array_push($arrayEmpleados,$objEmpleado);
        $datosTabla .= '<tr><td style="font-weight: 300;font-size:18px;">'.$objEmpleado->nombre.'<td><td style="font-weight: 300;font-size:18px;">'.$objEmpleado->apellido.'<td><td style="font-weight: 300;font-size:18px;">'.$objEmpleado->dni.'<td><td style="font-weight: 300;font-size:18px;">'.$objEmpleado->sexo.'<td><td style="font-weight: 300;font-size:18px;">'.$objEmpleado->legajo.'<td><td style="font-weight: 300;font-size:18px;">'.$objEmpleado->sueldo.'<td><td style="font-weight: 300;font-size:18px;">'.$objEmpleado->turno.'<td><td><img src='.$objEmpleado->pathFoto.' width="90px" height="90px"><td></tr>';
        if (count($arrayEmpleados) == $objFabrica->GetCantidadMaxima()) {
            echo '<td>'.'<h2>Ya no se pueden ingresar mas empleados, se ha superado la cantidad maxima</h2>'.'<td>';
        }
    }
    $tabla = "<table>".$encabezado.$datosTabla."</table>";
    $HTML = "<h2>Listado Empleados</h2>".$tabla;
    $mpdf->WriteHTML($HTML);

    //alineado izquierda | centro | alineado derecha
    $mpdf->setFooter('https://mfernandeztp.000webhostapp.com/');
    
    
    $mpdf->Output('MaximilianoFernandez.pdf', 'I');

?>