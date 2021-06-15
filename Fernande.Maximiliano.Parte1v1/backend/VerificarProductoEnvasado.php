<?php
    include("clases/ProductoEnvasado.php");
    $jsonx = isset($_POST["obj_producto"]) ? $_POST["obj_producto"] : NULL;
    $json = json_decode($jsonx);
    $arrayObjetos = ProductoEnvasado::Traer();
    foreach ($arrayObjetos as $objeto) {
        if($objeto->nombre == $json->nombre && $objeto->origen == $json->origen){
            echo $objeto->toJSON();
            $retorno = true;
            break;
        }else{
            $retorno = false;
        }
    }
    if($retorno == false){
        echo '{}';
    }


?>