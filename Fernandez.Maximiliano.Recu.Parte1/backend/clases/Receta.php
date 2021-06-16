<?php
    include_once("DB_PDO.php");
    include_once("IParte1.php");
    include_once("IParte2.php");
    include_once("IParte3.php");
    class Receta implements IParte1,IParte2,IParte3{
        public $id;
        public $nombre;
        public $ingredientes;
        public $tipo;
        public $pathFoto;

        public function __construct($id=null,$nombre=NULL,$ingredientes=null,$tipo=NULL,$pathFoto=null)
        {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->ingredientes = $ingredientes;
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
            $consulta = $objPDO->RetornarConsulta("INSERT INTO recetas (nombre, ingredientes, tipo, path_foto) VALUES(:nombre, :ingredientes, :tipo,:path_foto)");
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
            $consulta = $objPDO->RetornarConsulta( "UPDATE recetas SET nombre = :nombre, ingredientes = :ingredientes, tipo = :tipo, path_foto = :path_foto WHERE id = :id");
            $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
            $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
            $consulta->bindValue(':origen', $this->ingredientes, PDO::PARAM_STR);
            $consulta->bindValue(':precio', $this->tipo, PDO::PARAM_STR);
            $consulta->bindValue(':path_foto', $this->pathFoto, PDO::PARAM_STR);
            $retorno = $consulta->execute() != false ? true : false;
            return $retorno;
        }

        public function Existe($recetas){
            foreach ($recetas as $receta) {
                if($receta->nombre == $this->nombre && $receta->tipo == $this->tipo){
                    $retorno = true;
                    break;

                }else{
                    $retorno = false;
                }
            }
            return $retorno;
        }
        public function Eliminar(){
            $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","productos_db");
            $consulta = $objPDO->RetornarConsulta( "DELETE FROM productos WHERE nombre = :nombre AND tipo = :tipo");
            $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
            $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
            if($consulta->execute()){
                return true;
            }else{
                false;
            }
            
        }
        public function GuardarEnArchivo(){
            $stdClass = new stdClass();
            $archivo = fopen('./archivos/recetas_borradas.txt','a');
            //$obj = json_encode($this);
            $newLine = $this->nombre."-".$this->origen."-".$this->id."-".$this->codigoBarra."-".$this->precio."-".$this->pathFoto;
            $retorno = fwrite($archivo,$newLine."\r\n");
            $exito = $retorno != false ? true : false;
            if ($exito == true) {
                $stdClass->exito = true;
                $stdClass->mensaje = "Se pudo escribir en el archivo txt";
            }else{
                $stdClass->exito = false;
                $stdClass->mensaje = "No se pudo escribir en el archivo";
            }
            fclose($archivo);
            return json_encode($stdClass);
        }
    }

    ?>