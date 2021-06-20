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
            $objDatos = DB_PDO::InstanciarObjetoPDO("localhost","root","","recetas_bd");
            
             // //nombre,ingredientes,tipo,path_foto
             $consulta = $objDatos->RetornarConsulta("UPDATE recetas SET nombre=:nombre,ingredientes=:ingredientes,tipo=:tipo,path_foto=:foto WHERE recetas.id = :id ");

             $consulta->bindValue(':nombre',$this->nombre);
             $consulta->bindValue(':ingredientes',$this->ingredientes);
             $consulta->bindValue(':tipo',$this->tipo);
             $consulta->bindValue(':foto',$this->pathFoto);

             $consulta->bindValue(':id',$this->id);

             $consulta->execute();

             if($consulta->rowCount()>0)
             {
                 return true;
             }else{
                 echo'No se pudo modificar';
             }

             return false;
            // $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","recetas_bd");
            // $consulta = $objPDO->RetornarConsulta('UPDATE recetas SET nombre=:nombre,ingredientes=:ingredientes,tipo=:tipo,path_foto=:path_foto WHERE recetas.id=:id');
            
            // $consulta->bindValue(':nombre', $this->nombre /*PDO::PARAM_INT*/);
            // $consulta->bindValue(':origen', $this->ingredientes/*PDO::PARAM_INT*/);
            // $consulta->bindValue(':precio', $this->tipo/*PDO::PARAM_INT*/);
            // $consulta->bindValue(':path_foto', $this->pathFoto/*PDO::PARAM_INT*/);
            // $consulta->bindValue(':id', $this->id/*PDO::PARAM_INT*/);
            // var_dump($this->id);
            // $consulta->execute();
            // if($consulta->rowCount() > 0){
            //     $retorno = true;
            // }else{
            //     $retorno = false;
            // }
            // return $retorno;
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
            $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","recetas_db");
            $consulta = $objPDO->RetornarConsulta("DELETE FROM recetas WHERE nombre=:nombre AND tipo=:tipo");
            $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
            $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
            if($consulta->execute()){
                return true;
            }else{
                return false;
            }
            
        }
        public function GuardarEnArchivo(){
            $stdClass = new stdClass();
            $path = './archivos/recetas_borradas.txt';
            $archivoAbierto = fopen($path,'a');

            $extension = pathinfo("./recetas/imagenes/{$this->pathFoto}",PATHINFO_EXTENSION);
            $pathFotoBorrar = $this->id.'.'.$this->nombre.'.'.'borrado'.'.'.date('his').'.'.$extension;

            if($archivoAbierto){
                $recetaGuardar = $this->id.''.$this->nombre.''.$this->ingredientes.''.$this->tipo.''.$pathFotoBorrar;
                $outputFile = fwrite($archivoAbierto,$recetaGuardar."\r\n");
                
                if($outputFile > 0 && $outputFile != false)
                {
                    $stdClass->exito = true;
                    $stdClass->mensaje = 'se ha escrito en el archivo de recetas ELIMINADAS';
                    if (copy("./recetas/imagenes/{$this->pathFoto}","./recetas/recetasBorradas/$pathFotoBorrar") && unlink("./recetas/imagenes/{$this->pathFoto}"))
                    {
                        $stdClass->exito = true;
                        $stdClass->mensaje = 'Se ha guardado la receta eliminada en el archivo y se ha actualizado la crpeta RECETAS_BORRADAS';
                    }
                }else{
                    $stdClass->exito = false;
                    $stdClass->mensaje = 'no se pudo escribir en el archivo RECETASELIMINADAS.TXT';
                }
                fclose($archivoAbierto);
            }else{
                $stdClass->exito = false;
                $stdClass->mensaje = 'Hubo un error al abrir el archivo';
            }

            return json_encode($stdClass);
        }
            // $stdClass = new stdClass();
            // $archivo = fopen('./archivos/recetas_borradas.txt','a');
            // //$obj = json_encode($this);
            // $ubicacionOriginal = "./recetas/imagenes/".$this->pathFoto;
            // $extension = pathinfo($ubicacionOriginal,PATHINFO_EXTENSION);
            // $nuevaUbicacion = $this->id.".".$this->nombre."."."borrado".date('His').$extension;
            // $nuevoPath = "./recetasBorradas/".$this->id.".".$this->nombre."."."borrado".date('His').$extension;
            // $newLine = $this->id."-".$this->nombre."-".$this->ingredientes."-".$this->tipo."-".$nuevoPath;
            // if (fwrite($archivo,$newLine."\r\n") > 0 ) {
            //     copy($ubicacionOriginal,$nuevaUbicacion);
            //     unlink($ubicacionOriginal);
            //     $stdClass->exito = true;
            //     $stdClass->mensaje = "Se pudo escribir en el archivo txt";
            // }else{
            //     $stdClass->exito = false;
            //     $stdClass->mensaje = "No se pudo escribir en el archivo";
            // }
            // fclose($archivo);
            // return json_encode($stdClass);
    }
   // }

    ?>