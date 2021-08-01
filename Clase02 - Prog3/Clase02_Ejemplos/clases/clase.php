<?php

//CLASE QUE DERIVA DE LA CLASE ABSTRACTA
class Clase extends ClaseAbstracta //herencia
{
	//ATRIBUTOS
	public $otroAtributo;
	
	//CONSTRUCTOR
	public function __construct($valor, $otroValor)
	{
		parent::__construct($valor);//llama al constructor de la clase base
		$this->otroAtributo = $otroValor;
	}
	
	//IMPLEMENTO METODO ABSTRACTO
	public function MetodoAbstracto(){
		return "<br/>M&eacute;todo Abstracto";
	}
}