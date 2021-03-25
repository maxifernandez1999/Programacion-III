<?php
    /**Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
    contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
    lapiceras. */
    $lapicera = array('color' => '', 'marca' => '','trazo' => '','precio'=> '');
    foreach ($lapicera as $key => $value) {
        switch ($key) {
            case 'color':
                $lapicera['color'] = 'blanco';
            break;
            case 'marca':
                $lapicera['marca'] = 'vic';
            break;
            case 'trazo':
                $lapicera['trazo'] = 'fino';
            break;
            case 'precio':
                $lapicera['precio'] = '25';
            break;
            
            default:
                # code...
                break;
        }
    }
    var_dump($lapicera);
?>