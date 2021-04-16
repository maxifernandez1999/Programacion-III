<?php
    // *-CREAR PAGINA .PHP QUE RECIBA COMO PARAMETROS (POST)
    // *--OPCION, CORREO Y CLAVE
    // *---SI OPCION = 'LOGIN' => SE CONECTA CON LA BD Y VERIFICA EXISTENCIA DEL USUARIO.
    // *--->>>SI USUARIO NO COINCIDE => INFORMARLO, CASO CONTRARIO MOSTRAR: NOMBRE Y PERFIL (DESCRIPCION)
    // *---SI OPCION = 'MOSTRAR' => MOSTRARA EL LISTADO COMPLETO DE LOS USUARIOS
    // (ID, CORREO, CLAVE, NOMBRE, PERFIL (CODIGO) Y PERFIL (DESCRIPCION))
    
    // *-UNA VEZ TESTEADO EN EL ENTORNO LOCAL, SUBIR BASE Y PAGINA AL HOST REMOTO.
    // *-VERIFICAR EL BUEN FUNCIONAMIENTO (RETOCAR DE SER NECESARIO).
    // *-PUBLICAR LA URL DEL HOST PARA SER TESTEADO POR EL PROFESOR.
    $host = "sql308.epizy.com";	
    $user = "epiz_28384977";
    $password = "O32nJMvRBG";
    $database = "epiz_28384977_usuarios_test";
    if (isset($_POST['opcion']) && isset($_POST['correo']) && isset($_POST['clave'])){
        switch ($_POST['opcion']) {
            case 'login':
                $conexion = @mysqli_connect($host, $user, $password,$database);
                $sql = "SELECT * FROM usuarios";
                $rs = $conexion->query($sql);
                $i = 0;
                while ($row = $rs->fetch_assoc()){ 
                    $user_arr[] = $row;
                }
                while ($i < count($user_arr)) {
                    if ($user_arr[$i]['correo'] == $_POST['correo'] && $user_arr[$i]['clave'] == $_POST['clave']) {
                        $sqlInnerJoin = "SELECT * FROM usuarios INNER JOIN perfiles ON usuarios.id = perfiles.id;";
                        $rt= $conexion->query($sqlInnerJoin);
                        while($rows = $rt->fetch_assoc()){
                            $user_array[] = $rows;
                        }
                        echo 'Se ha encontrado coincidencia: <br>';
                        echo 'Nombre: '.$user_array[$i]['nombre'];
                        echo '<br>';
                        echo 'Descripcion: '.$user_array[$i]['descripcion'];
                        $retorno = true;
                        break;
                    }else{
                        $retorno = false;
                    }
                    $i++;
                }
                if($retorno == false){
                    echo 'El usuario no se encuentra en la BD';
                }
                mysqli_close($conexion);
            break;
            // (ID, CORREO, CLAVE, NOMBRE, PERFIL (CODIGO) Y PERFIL (DESCRIPCION))
            case 'mostrar':
                $i = 0;
                $conexion = @mysqli_connect($host, $user, $password,$database);
                $sql = "SELECT * FROM usuarios INNER JOIN perfiles ON usuarios.id = perfiles.id;";
                $rs = $conexion->query($sql);
                while ($row = $rs->fetch_assoc()){ 
                    $user_arr[] = $row;
                }
                while ($i < count($user_arr)){
                    echo 'USUARIO'.'<br>';
                    echo '<hr>';
                    echo 'ID: '.$user_arr[$i]['id'].'<br>'.'Correo: '.$user_arr[$i]['correo'].'<br>'.'Clave: '.$user_arr[$i]['clave'].'<br>'.'Nombre: '.$user_arr[$i]['nombre'].'<br>'.'Perfil (Codigo): '.$user_arr[$i]['perfil'].'<br>'.'Descripcion: '.$user_arr[$i]['descripcion'].'<br><br>';
                    $i++;
                }
                mysqli_close($conexion);
            break;
            
            default:
                # code...
                break;
        }
    }