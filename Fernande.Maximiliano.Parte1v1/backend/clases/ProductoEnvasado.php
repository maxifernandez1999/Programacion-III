<?php
    include_once("DB_PDO.php");
    include_once("Producto.php");
    include_once("IParte1.php");
    include_once("IParte2.php");
    include_once("IParte3.php");
    class ProductoEnvasado extends Producto implements IParte1,IParte2,IParte3{
        public $id;
        public $codigoBarra;
        public $precio;
        public $pathFoto;

        public function __construct($nombre,$origen,$id=null,$codigoBarra=null,$precio=null,$pathFoto=null)
        {
            parent::__construct($nombre,$origen);
            $this->id = $id;
            $this->codigoBarra = $codigoBarra;
            $this->precio = $precio;
            $this->pathFoto = $pathFoto;

        }
        public function toJSON(){
            $stdClass = new stdClass();
            $stdClass->nombre = $this->GetNombre();
            $stdClass->origen = $this->GetOrigen();
            $stdClass->id = $this->id;
            $stdClass->codigoBarra = $this->codigoBarra;
            $stdClass->precio = $this->precio;
            $stdClass->pathFoto =  $this->pathFoto;
            // $stdClass->clave = $this->clave;
            return json_encode($stdClass);
            
        }
        public static function Traer(){
            $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","productos_bd");
            $consulta = $objPDO->RetornarConsulta("SELECT * FROM productos");
            $consulta->execute();
            $arrayObjetos = array();
            while($obj = $consulta->fetchObject()){
                $productoEnvasado = new ProductoEnvasado($obj->nombre,$obj->origen,$obj->id,$obj->codigo_barra,$obj->precio,$obj->foto);
                array_push($arrayObjetos,$productoEnvasado);
            }
            return $arrayObjetos;
        }
        public function Agregar(){
            $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","productos_bd");
            $consulta = $objPDO->RetornarConsulta("INSERT INTO productos (nombre, origen, codigo_barra,precio,foto) VALUES(:nombre, :origen, :codigo_barra,:precio,:foto)");
            $consulta->bindValue(':origen', $this->GetOrigen(), PDO::PARAM_STR);
            $consulta->bindValue(':nombre', $this->GetNombre(), PDO::PARAM_STR);
            //$consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
            $consulta->bindValue(':codigo_barra', $this->codigoBarra, PDO::PARAM_INT);
            $consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);
            $consulta->bindValue(':foto', $this->pathFoto, PDO::PARAM_STR);
            $success = $consulta->execute() == true ? true : false;
            return $success;
        }
        public function Modificar(){ 
            $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","productos_db");
            $consulta = $objPDO->RetornarConsulta( "UPDATE productos SET nombre = :nombre, origen = :origen, codigo_barra = :codigo_barra, precio = :precio, foto = :foto WHERE id = :id");
            $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
            $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
            $consulta->bindValue(':origen', $this->origen, PDO::PARAM_STR);
            $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);
            $consulta->bindValue(':codigo_barra', $this->codigoBarra, PDO::PARAM_INT);
            $consulta->bindValue(':foto', $this->pathFoto, PDO::PARAM_STR);
            $retorno = $consulta->execute() != false ? true : false;
            return $retorno;
        }
        public static function Eliminar($id){
            $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","productos_db");
            $consulta = $objPDO->RetornarConsulta( "DELETE FROM productos WHERE id = :id");
            $consulta->bindValue(':id', $id, PDO::PARAM_INT);
            if($consulta->execute()){
                return true;
            }else{
                false;
            }
            
        }
        public function Existe($arrayProductosEnvasados){
            $retorno = false;
            foreach ($arrayProductosEnvasados as $producto) {
                if($producto->nombre == $this->nombre && $producto->origen == $this->origen){
                    $retorno = true;
                    break;
                }
            }
            return $retorno;
            
        }
        public function GuardarEnArchivo(){
            $stdClass = new stdClass();
            $archivo = fopen('./archivos/productos_envasados_borrados.txt','a');
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
        public static function MostrarBorradosJSON(){
            $ret = [];
            $archivo = fopen("./archivos/productos_eliminados.json", "r");
            $ret = fread($archivo,filesize("./archivos/productos_eliminados.json"));
            fclose($archivo);
            return $ret;
        }
        public static function MostrarModificados(){
            $path = "productosModificados/";
            $directorio = opendir($path);
            $retorno = array();
            while($elemento = readdir($directorio))
            {
                if($elemento != "." && $elemento != "..")
                {

                    array_push($retorno,$elemento);   
                   
                }
            }
            return $retorno;
    }
    }

?>