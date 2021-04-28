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
        //$this->conexion = @mysqli_connect($this->host, $this->user, $this->pass, $this->base);
    }

    //si la query es un SELECT retorna un array de objetos sql
    //si es distinto de SELECT retorna true OK, false, ERROR
    public function Query($secuenciaSQL){
        $sqlExplode = explode(" ",$secuenciaSQL);
        foreach ($sqlExplode as $value) {
            if ($value == "SELECT") {
                $ResponseSQL = $this->conexion->query($secuenciaSQL);
                $consulta = $this->ShowConsulta($ResponseSQL);
                //$this->CloseDB();
                return $consulta;
            }else{
                $valorRetorno = $this->conexion->query($secuenciaSQL) == true ? true : false;
                return $valorRetorno;
            }  
        }
    }
    public function Connection(){
        $this->conexion = @mysqli_connect($this->host, $this->user, $this->pass, $this->base);
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
 