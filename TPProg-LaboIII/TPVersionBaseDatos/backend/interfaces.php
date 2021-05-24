<?php
    interface ISQL{
        function SelectEmpleados();
        function InsertEmpleado($empleado);
        function UpdateEmpleado($empleado);
        function DeleteEmpleado($idEliminar);

    }
?>