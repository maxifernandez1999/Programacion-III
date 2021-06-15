<?php
    include_once("DB_PDO.php");
    interface IParte2{
        public function Modificar();
    
        public static function Eliminar($id);
    }
?>