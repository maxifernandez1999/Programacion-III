<?php
include_once("Televisor.php");
include_once("DB_PDO.php");

class Televisor implements IParte2,IParte3{

public $tipo;
public $precio;
public $paisOrigen;
public $path;


public function __construct($tipo=null,$precio=null,$paisOrigen=null,$path=null)
{
    $this->tipo = $tipo;
    $this->precio = $precio;
    $this->paisOrigen = $paisOrigen;
    $this->path = $path;
}
public function toString(){
    
    return $this->tipo."-".$this->precio."-".$this->paisOrigen."-".$this->path;
    
}
public function Agregar()
{
    $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","productos_db");
    $consulta = $objPDO->RetornarConsulta("INSERT INTO televisores (tipo, precio,pais,foto) VALUES(:tipo, :precio,:pais,:foto)");
    //$consulta->bindValue(':id', $this->GetOrigen(), PDO::PARAM_STR);
    $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
    //$consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
    $consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);
    $consulta->bindValue(':pais', $this->paisOrigen, PDO::PARAM_STR);
    $consulta->bindValue(':foto', $this->path, PDO::PARAM_STR);
    $success = $consulta->execute() == true ? true : false;
    return $success;
}
public function Traer(){
    $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","productos_bd");
    $consulta = $objPDO->RetornarConsulta("SELECT * FROM televisores");
    $consulta->execute();
    $arrayObjetos = array();
    while($obj = $consulta->fetchObject()){
        $televisor = new Televisor($obj->tipo,$obj->precio,$obj->paisOrigen,$obj->foto);
        array_push($arrayObjetos,$televisor);
    }
    return $arrayObjetos;
}
public function Verificar($televisores){
    foreach ($televisores as $tel) {
        if($tel->tipo == $this->tipo && $tel->paisOrigen == $this->paisOrigen){
            $retorno = false;
            break;
        }else{
            $retorno = true;
        }
    }
    return $retorno;
}
public function CalcularIVA()
{
    return $this->precio + ($this->precio * 21 / 100);
}
public function Modificar()
{
    $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","productos_db");
            $consulta = $objPDO->RetornarConsulta( "UPDATE televisores SET tipo = :tipo, precio = :precio, pais = :pais, foto = :foto WHERE id = :id");
            $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
            $consulta->bindValue(':nombre', $this->tipo, PDO::PARAM_STR);
            $consulta->bindValue(':origen', $this->paisOrigen, PDO::PARAM_STR);
            $consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);
            $consulta->bindValue(':codigo_barra', $this->path, PDO::PARAM_STR);
            $retorno = $consulta->execute() != false ? true : false;
            return $retorno;
}
}
?>