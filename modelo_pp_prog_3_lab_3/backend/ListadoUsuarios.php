<?php
    include_once("clases/Usuario.php");
    $arrayUsuarios = Usuario::TraerTodos();
    if (isset($_GET["tabla"]) & $_GET["tabla"] == "mostrar") {
        echo"<table align=center>
                <tr>
                    <th>ID</th>
                    <th>CORREO</th>
                    <th>DESCRIPCION</th>
                    <th>NOMBRE</th>
                    <th>ID_PERFIL</th>
                </tr>";
            foreach ($arrayUsuarios as $usuario) {
                echo"<tr>
                        <td>$usuario->id</td>
                        <td>$usuario->correo</td>
                        <td>$usuario->perfil</td>
                        <td>$usuario->nombre</td>
                        <td>$usuario->id_perfil</td>
                    </tr>";          
            } 
        echo "</table>";  
    }else{
        echo json_encode($arrayUsuarios);
        
    }


?>