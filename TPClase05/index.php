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
    $host = "tphosting.orgfree.com";	
    $user = "tphosting.orgfree.com";
    $password = "maxidelmillo12";
    $database = "267774";
    if (isset($_POST['opcion']) && isset($_POST['correo']) && isset($_POST['clave'])){
        switch ($_POST['opcion']) {
            case 'login':
                $conexion = @mysqli_connect($host, $user, $password,$database);
                $sqlInnerJoin = 'SELECT * FROM `usuarios` INNER JOIN `perfiles` ON `usuarios.id`= `perfiles.id`';
                $rt= $conexion->query($sqlInnerJoin);
                while($rows = $rt->fetch_object()){
                    $user_array[] = $rows;
                }
                foreach ($user_array as $value) {
                    if ($value->correo == $_POST['correo'] && $value->clave == $_POST['clave']) {
                        echo 'Se ha encontrado coincidencia: <br>';
                        echo 'Nombre: '.$value->nombre;
                        echo '<br>';
                        echo 'Descripcion: '.$value->descripcion;
                        $retorno = true;
                        break;
                    }else{
                        $retorno = false;
                    }
                }
                if($retorno == false){
                    echo 'El usuario no se encuentra en la BD';
                }
                mysqli_close($conexion);
            break;
            case 'mostrar':
                $conexion = @mysqli_connect($host, $user, $password,$database);
                $sql = "SELECT * FROM usuarios INNER JOIN perfiles ON usuarios.id = perfiles.id;";
                $rs = $conexion->query($sql);
                while ($row = $rs->fetch_object()){ 
                    $user_arr[] = $row;
                }
                foreach ($user_arr as $value) {
                    echo 'USUARIO'.'<br>';
                    echo '<hr>';
                    echo 'ID: '.$value->id.'<br>'.'Correo: '.$value->correo.'<br>'.'Clave: '.$value->clave.'<br>'.'Nombre: '.$value->nombre.'<br>'.'Perfil (Codigo): '.$value->perfil.'<br>'.'Descripcion: '.$value->descripcion.'<br><br>';
                }
                    
                mysqli_close($conexion);
            break;
            
            default:
                echo ':(';
            break;
        }
    }else{
        echo 'No existen las KEYS opcion, correo y clave';
    }