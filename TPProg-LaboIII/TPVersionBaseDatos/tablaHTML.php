<?php
    function GenerarTABLA($TDReturn){
        $tabla = '<table style="text-align: center;border-collapse:collapse;">'.GenerarHEAD().$TDReturn.'</table>';
        return $tabla;
    }
    function GenerarHEAD(){
        $HEAD = '<tr><td colspan="10"><h2>Listado de Empleados</h2></td></tr>
                <tr><td><h4>Info</h4></td></tr>
                <tr><td colspan="10"><hr></td></tr>
                <tr style="border: 1px solid #369;text-align:center;">
                <th style="border: 1px solid #369;padding:20px;">NOMBRE</th>
                <th style="border: 1px solid #369;padding:20px;">APELLIDO</th>
                <th style="border: 1px solid #369;padding:20px;">DNI</th>
                <th style="border: 1px solid #369;padding:20px;">SEXO</th>
                <th style="border: 1px solid #369;padding:20px;">LEGAJO</th>
                <th style="border: 1px solid #369;padding:20px;">SUELDO</th>
                <th style="border: 1px solid #369;padding:20px;">TURNO</th>
                <th style="border: 1px solid #369;padding:20px;">FOTO</th>
            </tr>';
        return $HEAD;
    }
    function GenerarTD($nombre,$apellido,$dni,$sexo,$legajo,$sueldo,$turno, $pathfoto){
        $TD = '<tr style="border: 1px solid #369;">
        <td style="border: 1px solid #369;padding:20px;">'.$nombre.'</td>
        <td style="border: 1px solid #369;padding:20px;">'.$apellido.'</td>
        <td style="border: 1px solid #369;padding:20px;">'.$dni.'</td>
        <td style="border: 1px solid #369;padding:20px;">'.$sexo.'</td>
        <td style="border: 1px solid #369;padding:20px;">'.$legajo.'</td>
        <td style="border: 1px solid #369;padding:20px;">'.$sueldo.'</td>
        <td style="border: 1px solid #369;padding:20px;">'.$turno.'</td>
        <td style="border: 1px solid #369;padding:20px;"><img src='.$pathfoto.' width="100px" height="100px"></td>
        </tr>';
        return $TD;
    }