<?php
 
    include("clases/Receta.php");
    $receta = isset($_POST["receta"]) ? $_POST["receta"] : NULL;
    $json = json_decode($receta);
    $arrayObjetos = Receta::Traer();
    foreach ($arrayObjetos as $objeto) {
        if($objeto->nombre == $json->nombre && $objeto->tipo == $json->tipo){
            echo $objeto->toJSON();
            $retorno = true;
            break;
        }else{
            $retorno = false;
        }
    }
    if($retorno == false){
        echo 'NO coinciden el tipo y el nombre';
    }


?>