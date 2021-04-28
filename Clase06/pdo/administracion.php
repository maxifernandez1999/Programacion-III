<?php

$queMuestro = isset($_POST['queMuestro']) ? $_POST['queMuestro'] : NULL;

switch ($queMuestro) {

    case "conexionBasica":
    
        $obj = new stdClass();
        $obj->Exito = TRUE;
        $obj->Mensaje = "";
        $obj->Html = "";

        try {

            //CREO INSTANCIA DE PDO, INDICANDO ORIGEN DE DATOS, USUARIO Y CONTRASEÑA
            $usuario='root';
            $clave='';

            $objetoPDO = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', $usuario, $clave);

            $obj->Html = "objetoPDO = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', 'root', '')";

            $obj->Mensaje = "Conexión establecida!!!";
            
        } catch (PDOException $e) {

            $obj->Exito = FALSE;
            $obj->Mensaje = "Error!!!\n" . $e->getMessage();
        }

        echo json_encode($obj);

        //LA CONEXION TERMINA CUANDO IGUALO EL OBJETOPDO A NULL O CUANDO TERMINA EL SCRIPT

        break;

    case "conexion":

        $obj = new stdClass();
        $obj->Exito = TRUE;
        $obj->Mensaje = "";
        $obj->Html = "";

        try {

            //CREO INSTANCIA DE PDO, INDICANDO ORIGEN DE DATOS, USUARIO, CONTRASEÑA Y PARAMETROS ADICIONALES
            $usuario='root';
            $clave='';
            //INVESTIGAR
            $parametros=array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

            $objetoPDO = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', $usuario, $clave, $parametros);
            
            //sirve para establecer el charset.
            //no se utiliza porque se agrega "charset=utf8" en el constructor.
            //$objetoPDO->exec('SET CHARACTER SET utf8');

            $obj->Html = "objetoPDO = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', usuario, clave, parametros);";
            
            $obj->Mensaje = "Conexión establecida!!!";

        } catch (PDOException $e) {

            $obj->Exito = FALSE;
            $obj->Mensaje = "Error!!!\n" . $e->getMessage();
        }

        echo json_encode($obj);

        break;

    case "query_fetchAll":

        $obj = new stdClass();
        $obj->Exito = TRUE;
        $obj->Mensaje = "";
        $obj->Html = "";

        try {
            //CREO INSTANCIA DE PDO, INDICANDO ORIGEN DE DATOS, USUARIO Y CONTRASEÑA
            $usuario='root';
            $clave='';

            $db = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', $usuario, $clave);
            $obj->Mensaje = "FETCHALL";

            //AS hace referencia a los alias
            $sql = $db->query('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds');
            //si se quiere acceder a una tabla que esta en otra base se hace FROM base.tabla
            $catidadFilas = $sql->rowCount();

            $obj->Html = "Cantidad de filas: " . $catidadFilas . "---";

            //fetchall se le puede pasar por parametros la forma de indexar el aray que devuelve

            //por defecto devuelve un array both 
            //en el indice asociativo se le pasa el alias
            $resultado = $sql->fetchall();

            foreach ($resultado as $fila) {
                $obj->Html .= "- Título: " . $fila[0];
                $obj->Html .= "- Año: " . $fila[2];
                $obj->Html .= "- Cantante: " . $fila['interprete'] . "---";
            }            
                
        } catch (PDOException $e) {

            $obj->Exito = FALSE;
            $obj->Mensaje = "Error!!!\n" . $e->getMessage();
        }

        echo json_encode($obj);

        break;

    case "query_fetchOject":

        $obj = new stdClass();
        $obj->Exito = TRUE;
        $obj->Mensaje = "";
        $obj->Html = "";
        //NECESITA EL REQUIERE DEL OBJETO
        require_once "../clases/cd.php";
      
        try {
            $usuario='root';
            $clave='';

            $db = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', $usuario, $clave);
            $obj->Mensaje = "FETCHOBJECT";

            $sql = $db->query('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds');

            $obj->Html = "";

            //fetchObject genera un objeto del tipo que pasamos por parametro 
            //por cada linea que lee
            while ($fila = $sql->fetchObject("cd"/*array de parametros para el constructor*/ )) {//FETCHOBJECT -> RETORNA UN OBJETO DE UNA CALSE DADA
                $obj->Html .= "**". $fila->MostrarDatos(). '**';
            }
        
        } catch (PDOException $e) {

            $obj->Exito = FALSE;
            $obj->Mensaje = "Error!!!\n" . $e->getMessage();
        }
        
        echo json_encode($obj); //convierte el objeto a un string de tipo json para poder enviarlo hace el frontend

        break;

    case "prepare":

        try {
            //CREO INSTANCIA DE PDO, INDICANDO ORIGEN DE DATOS, USUARIO Y CONTRASEÑA
            $usuario='root';
            $clave='';

            $pdo = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', $usuario, $clave);
            
            //prepara la consulta pero no la ejecuta para optimizar
            $sentencia = $pdo->prepare('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds');
            
            $sentencia->execute();//aca la ejecuto            
            
            //var_dump($sentencia);
            
            //su puede utilizar en el Mostrar.php
            $tabla = "<table><tr><td>TITULO</td><td>INTERPRETE</td><td>AÑO</td></tr>";
            while($fila = $sentencia->fetch()){
                $tabla .= "<tr><td>{$fila[0]}</td><td>{$fila['interprete']}</td><td>{$fila[2]}</td></tr>";
            }
            $tabla .= "</table>";
            
            echo $tabla;

            $sentencia->execute();//aca la ejecuto otra vez            
            echo "
            ";
            var_dump($sentencia->fetch());
            
        } catch (PDOException $e) {

            echo "Error!!!\n" . $e->getMessage();
        }

        break;

    case "prepareParam":

        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
    
        try {
            //CREO INSTANCIA DE PDO, INDICANDO ORIGEN DE DATOS, USUARIO Y CONTRASEÑA
            $usuario='root';
            $clave='';

            $pdo = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', $usuario, $clave);
            // EL AS ES ALIAS
            //CON PARAMETRO NOMBRADO
            $sentencia = $pdo->prepare('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds WHERE id = :id');//paso el parametro id vacio en el prepere
            
            $sentencia->execute(array("id" => $id));//agrega el parametro vacio.            
            
            $tabla = "<table><tr><td>TITULO</td><td>INTERPRETE</td><td>AÑO</td></tr>";
            while($fila = $sentencia->fetch()){
                $tabla .= "<tr><td>{$fila[0]}</td><td>{$fila[1]}</td><td>{$fila['anio']}</td></tr>";
            }
            $tabla .= "</table>";
            
            echo $tabla;

            $sentencia->execute(array("id" => 4));            
            echo "
            ";
            var_dump($sentencia->fetch());
           
        } catch (PDOException $e) {

            echo "Error!!!\n" . $e->getMessage();
        }
        
        break;
        
    case "bindParam":
    
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
    
        try {
            //CREO INSTANCIA DE PDO, INDICANDO ORIGEN DE DATOS, USUARIO Y CONTRASEÑA
            $usuario='root';
            $clave='';

            $pdo = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', $usuario, $clave);
            
            //CON PARAMETRO POSICIONAL
            $sentencia = $pdo->prepare('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds WHERE id = ?');
            $sentencia->bindParam(1,  $id, PDO::PARAM_INT); // LAS POSICIONES SON INDICE 1 (NO 0)

            $sentencia->execute();        
            //CON PARAMETRO NOMBRADO
            // $sentencia = $pdo->prepare('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds WHERE id = ?');
            // $sentencia->bindParam(1,  $id, PDO::PARAM_INT);

            //$sentencia->execute();   
            
            $tabla = "<table><tr><td>TITULO</td><td>INTERPRETE</td><td>AÑO</td></tr>";
            while($fila = $sentencia->fetch()){
                $tabla .= "<tr><td>{$fila[0]}</td><td>{$fila[1]}</td><td>{$fila['anio']}</td></tr>";
            }
            $tabla .= "</table>";
            
            echo $tabla;

            //CAMBIO EL VALOR DEL PARAMETRO
            $id = 5;
            $sentencia->execute();

            echo "
            ";
            var_dump($sentencia->fetch());
            
        } catch (PDOException $e) {

            echo "Error!!!\n" . $e->getMessage();
        }
        
        break;
        
    case "bindValue":
    
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        //La diferencia con el bindParam es que no puedo cambiar el valor del parametro porque lo toma como constante en el primer execute
        try {
            //CREO INSTANCIA DE PDO, INDICANDO ORIGEN DE DATOS, USUARIO Y CONTRASEÑA
            $usuario='root';
            $clave='';

            $pdo = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', $usuario, $clave);
            
            //CON PARAMETRO POSICIONAL
            $sentencia = $pdo->prepare('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds WHERE id = :id');
            $sentencia->bindValue(':id',  $id, PDO::PARAM_INT);

            $sentencia->execute();            
            
            $tabla = "<table><tr><td>TITULO</td><td>INTERPRETE</td><td>AÑO</td></tr>";
            while($fila = $sentencia->fetch()){
                $tabla .= "<tr><td>{$fila[0]}</td><td>{$fila[1]}</td><td>{$fila['anio']}</td></tr>";
            }
            $tabla .= "</table>";
            
            echo $tabla;

            //CAMBIO EL VALOR DEL PARAMETRO
            $id = 4;
            $sentencia->execute();

            echo "
            ";
            var_dump($sentencia->fetch());
            
        } catch (PDOException $e) {

            echo "Error!!!\n" . $e->getMessage();
        }
        
        break;

    case "bindColumn":

        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        
        try {
            //CREO INSTANCIA DE PDO, INDICANDO ORIGEN DE DATOS, USUARIO Y CONTRASEÑA
            $usuario='root';
            $clave='';

            $pdo = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', $usuario, $clave);
            
            //CON PARAMETRO POSICIONAL
            $sentencia = $pdo->prepare('SELECT id, titel AS titulo, interpret AS interprete, jahr AS anio FROM cds WHERE id > :id');
            $sentencia->bindParam(':id',  $id, PDO::PARAM_INT);

            //ENLAZO LAS COLUMNAS A PARAMETROS, UTILIZO EL FETCH_BOUND
            $sentencia->bindColumn(1, $colId, PDO::PARAM_INT, 20);//ENCAPSULA LOS DATOS POR COLUMNAS
            $sentencia->bindColumn(3, $colInterprete, PDO::PARAM_STR, 256);
            $sentencia->bindColumn(4, $colAnio, PDO::PARAM_STR, 256);
            $sentencia->bindColumn(2, $colTitulo, PDO::PARAM_STR, 256);

            $sentencia->execute();            
            
            $tabla = "<table><tr><td>ID</td><td>INTERPRETE</td><td>AÑO</td><td>TITULO</td></tr>";
            while($fila = $sentencia->fetch(PDO::FETCH_BOUND)){
                $tabla .= "<tr><td>{$colId}</td><td>{$colInterprete}</td><td>{$colAnio}</td><td>{$colTitulo}</td></tr>";
            }
            $tabla .= "</table>";
            
            echo $tabla;
            
        } catch (PDOException $e) {

            echo "Error!!!\n" . $e->getMessage();
        }
        
        break;
          
    case "fetch_lazy":

        try {
            //CREO INSTANCIA DE PDO, INDICANDO ORIGEN DE DATOS, USUARIO Y CONTRASEÑA
            $usuario='root';
            $clave='';

            $db = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', $usuario, $clave);
            
            $sql = $db->query('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds');

            $tabla = "<table><tr><td>TITULO</td><td>INTERPRETE</td><td>AÑO</td></tr>";
            //PERMITE EJECUTAR UN OBJETO LIVIANO
            while ($obj = $sql->fetch(PDO::FETCH_LAZY)) {//FETCH_LAZY -> RETORNA UN OBJETO
                $tabla .= "<tr><td>{$obj->titulo}</td><td>{$obj->interprete}</td><td>{$obj->anio}</td></tr>";
            }
            $tabla .= "</table>";
            
            echo $tabla;

        } catch (PDOException $e) {

            echo "Error!!!\n" . $e->getMessage();
        }
        
        break;
    
    case "fetch_into":

        require_once "../clases/cd.php";
    
        try {
            //CREO INSTANCIA DE PDO, INDICANDO ORIGEN DE DATOS, USUARIO Y CONTRASEÑA
            $usuario='root';
            $clave='';

            $db = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', $usuario, $clave);
            
            $sql = $db->query('SELECT titel AS titulo, interpret AS interprete, jahr AS anio FROM cds');

            //GENERO LA CLASE DONDE QUIERO ENLAZAR
            $sql->setFetchMode(PDO::FETCH_INTO, new cd);
                        
            foreach($sql as $cd){
                
                echo "**". $cd->MostrarDatos(). '**
                ';
            }

        } catch (PDOException $e) {

            echo "Error!!!\n" . $e->getMessage();
        }

        break;

    default:
        echo ":(";
}