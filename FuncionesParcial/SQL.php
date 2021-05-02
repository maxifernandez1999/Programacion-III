<?php
    include_once("POO/DB_PDO.php");
    class SQL{
        public static function Traer(){
            $objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","database");
            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT x,y,z FROM usuarios");   
            $ConsultaEjecutada = $consulta->execute();                                              
            return $ConsultaEjecutada;
        }
              
    
        public function Insertar(){
        
            $objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","database");
        
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO usuarios(x,y,z) VALUES (x,y,x)");
            $consulta->bindValue(':x', $this->id, PDO::PARAM_INT);
            $consulta->bindValue(':y', $this->titulo, PDO::PARAM_STR);
            $consulta->bindValue(':z', $this->anio, PDO::PARAM_INT);
            $consulta->execute();   

        }
    
        public static function Modificar($id, $titulo, $anio, $cantante)
        {

            $objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","database");
        
            $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE usuarios SET x = :x,y = :y,z= :z");
        
            $consulta->bindValue(':x', $id, PDO::PARAM_INT);
            $consulta->bindValue(':y', $titulo, PDO::PARAM_STR);
            $consulta->bindValue(':z', $anio, PDO::PARAM_INT);

            return $consulta->execute();

        }

        public static function EliminarCD($cd){
            $objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","database");
            $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM usuarios WHERE id = :id");
        
            $consulta->bindValue(':id', $cd->id, PDO::PARAM_INT);

            return $consulta->execute();

        }
    }

?>