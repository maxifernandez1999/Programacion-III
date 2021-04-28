<?php
    include("DB_PDO.php");
    $op = isset($_POST['opcion']) ? $_POST['opcion'] : NULL;
    $clave = isset($_POST['clave']) ? $_POST['clave'] : NULL;
    $correo = isset($_POST['correo']) ? $_POST['correo'] : NULL;
    $retorno = false;
    $objPDO = DB_PDO::InstanciarObjetoPDO("localhost","root","","usuarios_test");
    switch ($op){
        case 'login':
            $consulta = $objPDO->RetornarConsulta("SELECT * FROM usuarios INNER JOIN perfiles ON usuarios.id = perfiles.id");
            $consulta->execute();
            $resultado = $consulta->fetchAll();
            foreach ($resultado as $value) {
                if($value["clave"] == $clave && $value["correo"] == $correo){
                    echo "Nombre: ".$value["nombre"].'<br>';
                    echo "Descripcion: ".$value["descripcion"];
                    $retorno = true;
                    break;
                }
            }
            $mensaje = $retorno == false ? "El usuario no se encuentra en la base de datos" : NULL;
        break;
        case 'mostrar':
            $consulta = $objPDO->RetornarConsulta("SELECT * FROM usuarios INNER JOIN perfiles ON usuarios.id = perfiles.id");
            $consulta->execute();
            $resultado = $consulta->fetchAll();
            foreach ($resultado as $value) {
                echo "Nombre: ".$value["nombre"].'<br>';
                echo "ID: ".$value["id"].'<br>';
                echo "Correo: ".$value["correo"].'<br>';
                echo "Clave: ".$value["clave"].'<br>';
                echo "Perfil: ".$value["perfil"].'<br>';
                echo "Descripcion: ".$value["descripcion"].'<br><br>';
            }
        break;
        case "alta":
            // *-AGREGAR ABM SOBRE LOS USUARIOS. 
            // *-- *-ALTA-> RECIBE UN JSON (OBJ_JSON) CON TODOS LOS NUEVOS DATOS.
            $objJSON = isset($_POST['obj_json']) ? json_decode($_POST['obj_json']) : NULL;
            $consulta = $objPDO->RetornarConsulta("INSERT INTO usuarios (correo, clave, nombre, perfil) VALUES(:correo, :clave, :nombre, :perfil)");
            $consulta->bindValue(':correo', $objJSON->correo, PDO::PARAM_STR);
            $consulta->bindValue(':nombre', $objJSON->nombre, PDO::PARAM_STR);
            $consulta->bindValue(':perfil', $objJSON->perfil, PDO::PARAM_INT);
            $consulta->bindValue(':clave', $objJSON->clave, PDO::PARAM_STR);
            $consulta->execute();
            echo "Se ha agregado el usuario a la base de datos";
        break;
        case 'modificacion':
            // *-- *-MODIFICACION-> RECIBE UN ID Y UN JSON (OBJ_JSON). EL ID CORRESPONDE AL REGISTRO A SER MODIFICADO, MIENTRAS QUE EL JSON TENDRÁ LOS DATOS NUEVOS DE ESE REGISTRO.
            $objJSON = isset($_POST['obj_json']) ? json_decode($_POST['obj_json']) : NULL;
            $id = isset($_POST["id"]) ? $_POST["id"] : NULL;
            $consulta = $objPDO->RetornarConsulta( "UPDATE usuarios SET correo = :correo, clave = :clave, nombre = :nombre, perfil = :perfil WHERE id = :id");
            $consulta->bindValue(':id', $id, PDO::PARAM_INT);
            $consulta->bindValue(':correo', $objJSON->correo, PDO::PARAM_STR);
            $consulta->bindValue(':clave', $objJSON->clave, PDO::PARAM_STR);
            $consulta->bindValue(':nombre', $objJSON->nombre, PDO::PARAM_STR);
            $consulta->bindValue(':perfil', $objJSON->perfil, PDO::PARAM_INT);
            
            $consulta->execute();
            echo "Se ha modificado correctamente";

           
        break;
        case 'baja':
            // *-- *-BAJA-> RECIBE EL ID DEL REGISTRO A SER BORRADO.
            $id = isset($_POST["id"]) ? $_POST["id"] : NULL;
            $consulta = $objPDO->RetornarConsulta("DELETE FROM usuarios WHERE id = :id");
            $consulta->bindValue(':id', $id, PDO::PARAM_INT);
             
            $consulta->execute();
            echo "Se ha eliminado correctamente";
        break;
        default:
            echo ":(";
        break;
    }
?>