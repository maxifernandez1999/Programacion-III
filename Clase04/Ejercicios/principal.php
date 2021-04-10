<?php
    session_start();
    // Página principal.php:
    // Muestra en un <h1> el legajo del alumno y
    // en un <h2> el nombre y apellido del alumno logueado.
    // Muestra el contenido completo del archivo ./archivos/alumnos.txt en una tabla.
    // Cada registro se mostrará:
    // *- legajo - apellido - nombre - foto (path)
    
    echo '<h1>'.$_SESSION['datos'][2].'</h1><br>';
    echo '<h1>'.$_SESSION['nombre'][0].' '.$_SESSION['apellido'][1].'</h1>';

    $open = fopen('../archivos/alumnos.txt','r');
    if ($open > 0) {
        if (!feof($open)) {
            $string = fgets($open);
            $arrayString = explode(' - ',$string);
            for ($i=0; $i < count($arrayString); $i++) {
                ?>
                <table>
                    <tr>
                        <td><?php echo $arrayString[1] ?></td>
                        <td><?php echo $arrayString[2] ?></td>
                        <td><?php echo $arrayString[3] ?></td>
                        <td><?php echo $arrayString[4] ?></td>
                        <td><?php echo $arrayString[5] ?></td>
                    </tr>
                </table>
                <?php    
            }
            
        }
    }

?>