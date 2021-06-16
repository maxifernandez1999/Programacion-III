<?php
    include_once("clases/Cocinero.php");
    echo json_encode(Cocinero::TraerTodos("./archivos/cocinero.json"));

    
    

?>