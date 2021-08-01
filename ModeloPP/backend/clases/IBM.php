<?php
    include_once("DB_PDO.php");
    interface IBM{
        public function Modificar();
    
        public static function Eliminar($id);
    }
?>