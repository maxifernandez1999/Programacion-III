<?php

    class Garage{
        private $razonSocial;
        private $precioPorHora;
        private $autos;

        public function __construct($razonSocial,$precioPorHora = 0)
        {
            $this->razonSocial = $razonSocial;
            $this->precioPorHora = $precioPorHora;
            $this->autos = array();
        }

        public function MostrarGarage(){
            echo 'RazonSocial: '.$this->razonSocial.'<br>'.'Precio por hora:
            '.$this->precioPorHora.'<br>Autos:<br>';

            foreach($this->autos as $auto){
                Auto::MostrarAuto($auto).'<br>';
            }
        }

        public function Equals($auto){
            foreach ($this->autos as $autoGarage) {
                if($autoGarage == $auto){
                    return true;
                }
            }
            
            return false;
        }

        public function Add($auto){
            if(!$this->Equals($auto)){
                array_push($this->autos,$auto);
            }else{
                echo 'El auto ya se encuentra en el garage';
            }
        }

        public function Remove($auto){
            if ($this->Equals($auto)) {
                foreach ($this->autos as $key => $autoGarage) {
                    if ($autoGarage == $auto) {
                        unset($this->autos[$key]);
                    }
                }
            }else{
                echo 'El auto no se encuentra en el garage';
            }
        }
    }
?>