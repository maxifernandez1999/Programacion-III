<?php
    class Rectangulo{
        private $_vertice1;
        private $_vertice2;
        private $_vertice3;
        private $_vertice4;
        public $ladoUno;
        public $ladoDos;
        public $perimetro;
        public $area;

        public function __construct($v1,$v3)
        {
            $this->ladoUno = 20;
            $this->ladoDos = 20;
            $this->area = 50;
            $this->perimetro = 80;
        }
    }
    
?>