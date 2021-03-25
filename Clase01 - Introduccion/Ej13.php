<?php
    /**Cargar los tres arrays con los siguientes valores y luego ‘juntarlos’ en uno. Luego mostrarlo por
    pantalla.
    “Perro”, “Gato”, “Ratón”, “Araña”, “Mosca”
    “1986”, “1996”, “2015”, “78”, “86”
    “php”, “mysql”, “html5”, “typescript”, “ajax”
    Para cargar los arrays utilizar la función array_push. Para juntarlos, utilizar la función
    array_merge. */
    $vecAnimals = array();
    $vecYear = array();
    $vecLanguage = array();
    array_push($vecAnimals,'Perro','Gato','Raton','Arania','Mosca');
    array_push($vecYear,'1986','“1996','2015','78','86');
    array_push($vecLanguage,'php','mysql','html5','typescript','ajax');
    $newvec = array_merge($vecAnimals,$vecLanguage,$vecYear);
    var_dump($newvec);
?>