<?php
class Usuarios
{
    public $id;
    public $titulo;
    public $interprete;
    public $anio;

    public function MostrarDatos()
    {
        return $this->id." - ".$this->titulo." - ".$this->interprete." - ".$this->anio;
    }
    //AGREGAR UNA FUNCION QUE TRAIGA LA CONSULTA PREPARADA SIN EJECUTARLA
    public static function Traer()
    {    
        $objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","database");
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT id, titel AS titulo, interpret AS interprete, "
                                                        . "jahr AS anio FROM cds");        
        
        $consulta->execute();
        
        $consulta->setFetchMode(PDO::FETCH_INTO, new Usuarios);                                                

        return $consulta; 
    }
    
    public function Insertar()
    {
        $objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","database");
        
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO cds (id, titel, interpret, jahr)"
                                                    . "VALUES(:id, :titulo, :cantante, :anio)");
        
        $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
        $consulta->bindValue(':titulo', $this->titulo, PDO::PARAM_STR);
        $consulta->bindValue(':anio', $this->anio, PDO::PARAM_INT);
        $consulta->bindValue(':cantante', $this->interprete, PDO::PARAM_STR);

        $consulta->execute();   

    }
    
    public static function Modificar($id, $titulo, $anio, $cantante)
    {

        $objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","database");
        
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE cds SET titel = :titulo, interpret = :cantante, 
                                                        jahr = :anio WHERE id = :id");
        
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':titulo', $titulo, PDO::PARAM_STR);
        $consulta->bindValue(':anio', $anio, PDO::PARAM_INT);
        $consulta->bindValue(':cantante', $cantante, PDO::PARAM_STR);

        return $consulta->execute();

    }

    public static function EliminarCD($cd)
    {

        $objetoAccesoDato = DB_PDO::InstanciarObjetoPDO("localhost","root","","database");
        
        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM cds WHERE id = :id");
        
        $consulta->bindValue(':id', $cd->id, PDO::PARAM_INT);

        return $consulta->execute();

    }
    
}