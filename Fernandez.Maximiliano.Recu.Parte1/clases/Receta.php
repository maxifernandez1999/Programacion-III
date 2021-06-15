<?php
    include_once("DB_PDO.php");
    include_once("IParte1.php");
    class Receta implements IParte1{
        public $id;
        public $nombre;
        public $ingredientes;
        public $tipo;
        public $pathFoto;

        public function __construct($id=null,$nombre=NULL,$ingredientes=null,$tipo=NULL,$pathFoto=null)
        {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->preingredientescio = $ingredientes;
            $this->tipo = $tipo;
            $this->pathFoto = $pathFoto;

        }
        public function toJSON(){
            return json_encode($this);
            
        }
        public static function Traer(){
            $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","recetas_bd");
            $consulta = $objPDO->RetornarConsulta("SELECT * FROM recetas");
            $consulta->execute();
            $arrayObjetos = array();
            while($obj = $consulta->fetchObject()){
                $receta = new Receta($obj->id,$obj->nombre,$obj->ingredientes,$obj->tipo,$obj->path_foto);
                array_push($arrayObjetos,$receta);
            }
            return $arrayObjetos;
        }
        public function Agregar(){
            $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","recetas_bd");
            $consulta = $objPDO->RetornarConsulta("INSERT INTO recetas (nombre, ingredientes,tipo,path_foto) VALUES(:nombre, :ingredientes,:tipo,:path_foto)");
            $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
            //$consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
            $consulta->bindValue(':ingredientes', $this->ingredientes, PDO::PARAM_STR);
            $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
            $consulta->bindValue(':path_foto', $this->pathFoto, PDO::PARAM_STR);
            $success = $consulta->execute() == true ? true : false;
            return $success;
        }

        public function Modificar(){ 
            $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","recetas_bd");
            $consulta = $objPDO->RetornarConsulta( "UPDATE recetas SET nombre = :nombre, ingredientes = :ingredientes, tipo = :tipo, foto = :foto WHERE id = :id");
            $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
            $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
            $consulta->bindValue(':origen', $this->ingredientes, PDO::PARAM_STR);
            $consulta->bindValue(':precio', $this->tipo, PDO::PARAM_STR);
            $consulta->bindValue(':foto', $this->pathFoto, PDO::PARAM_STR);
            $retorno = $consulta->execute() != false ? true : false;
            return $retorno;
        }
        
    }

    ?>