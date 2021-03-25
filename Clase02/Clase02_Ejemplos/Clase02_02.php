<?php 

	//INCLUDE : si NO existe tira un warning pero continua con la ejecucion
	//REQUIRE: tira un error, si no existe el archivo
	include "no_existe.php"; // si esta dentro de un subdirectorio /su/archivo.php
	//si esta un nivel mas arriba /..

//		require "no_existe.php";

