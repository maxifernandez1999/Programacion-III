<?php
    if (isset($_POST["valor"])) {
        $cantidadNum = 0;
        for ($i=0; $i < $_POST["valor"] ; $i++) { 
            if($i % 2 == 1){
                $cantidadNum++;
                
            }
        }
        echo $cantidadNum;
    }

?>