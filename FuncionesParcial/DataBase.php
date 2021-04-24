<?php
$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;
class DataBase{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $base = "productos";
    private $conexion;
     
    public function __construct($host,$user,$pass,$base){
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->base = $base;
        $this->conexion = @mysqli_connect($this->host, $this->user, $this->pass, $this->base);
    }
    public function Query($secuenciaSQL){
        $ResponseSQL = $this->conexion->query($secuenciaSQL);
        return $ResponseSQL;
    }

    //retorno un array de objetos
    public function ShowConsulta($ResponseSQL){
        while ($row = $ResponseSQL->fetch_object()){ 
            $user_arr[] = $row;
        }       
        return $user_arr; 
    }
    public function CloseDB(){
        mysqli_close($this->conexion);
    }
}

//"INSERT INTO producto (codigo_barra, nombre, path_foto)
                //VALUES(1112, 'nombre_producto', 'fake.jpg')";
                //$sql = "SELECT * FROM $tabla";


    //$sql = "UPDATE producto SET codigo_barra=555, nombre='otro_nombre', path_foto='otroFake.jpg'
                //WHERE id = 2";
    
    //"DELETE FROM producto WHERE id=2";
 