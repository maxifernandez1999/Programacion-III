<?php
    // Realizar una clase llamada “Auto” que posea los siguientes atributos privados:

    // _color (String)
    // _precio (Double)
    // _marca (String).
    // _fecha (DateTime)
    
    // Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:
    
    // i. La marca y el color.
    // ii. La marca, color y el precio.
    // iii. La marca, color, precio y fecha.
    
    // Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble por
    // parámetro y que se sumará al precio del objeto.
    // Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto” por
    // parámetro y que mostrará todos los atributos de dicho objeto.
    // Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo
    // devolverá TRUE si ambos “Autos” son de la misma marca.
    // Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son de la
    // misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con la suma
    // de los precios o cero si no se pudo realizar la operación.

    class Auto{
        private $_color;
        private $_precio;
        private $_marca;
        private $_fecha;

        public function __construct($marca,$color,$precio = 0,$fecha = '')
        {
            $this->_marca;
            $this->_color;
            $this->_precio;
            $this->_fecha;
        }
        // public function __construct1($marca,$color,$precio)
        // {
        //     $this->__construct($marca,$color);
        //     $this->_precio;

        // }
        // public function __construct2($marca,$color,$precio,$fecha)
        // {
        //     $this->__construct1($marca,$color,$precio);
        //     $this->_fecha;
        // }
        public function AgragarImpuestos($impuesto){
            $this->_precio + $impuesto;
        }

        public static function MostrarAuto($auto){
            echo $auto->_color;
            echo $auto->_precio;
            echo $auto->_marca;
            echo $auto->_fecha;
            
        }
        public function Equals($auto1){
            if ($auto1->_marca == $this->_marca) {
                return true;
            }else{
                return false;
            }
        }
        public static function Add($auto1,$auto2){
            if($auto1->_marca == $auto2->_marca && $auto1->_color == $auto2->_marca){
                return $auto1->_precio + $auto2->_precio;
            }else{
                return 0;
            }
        }
        
    }

?>
