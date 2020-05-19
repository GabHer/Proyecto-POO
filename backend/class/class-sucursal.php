<?php
    class Sucursal{
        private $nameSucursal; 
        private $emailSucursal; 
        private $addressSucursal; 
        private $phoneSucursal; 
        private $latitudeSucursal; 
        private $longitudeSucursal; 
        private $urlProfileImageSucursal; 

        public function __construct(
            $nameSucursal,
            $emailSucursal,
            $addressSucursal,
            $phoneSucursal,
            $latitudeSucursal,
            $longitudeSucursal,
            $urlProfileImageSucursal
        )
        {
            $this->nameSucursal= $nameSucursal;
            $this->emailSucursal= $emailSucursal;
            $this->addressSucursal= $addressSucursal;
            $this->phoneSucursal= $phoneSucursal;
            $this->latitudeSucursal= $latitudeSucursal;
            $this->longitudeSucursal= $longitudeSucursal;
            $this->urlProfileImageSucursal= $urlProfileImageSucursal;
        }

        public function guardarSucursal($db, $idEmpresa){
            $sucursal= $this->getData();
            $ref ="enterprises/".$idEmpresa."/sucursales";
            $result= $db->getReference($ref)->push($sucursal);

            if ($result->getKey()!= null)
                return '{"mensaje":"Sucursal almacenada","key":"'.$result->getKey().'"}';
            else
                return '{"mensaje":"Sucursal no pudo ser almacenada"}';
            
        }

    
        public static function obtenerSucursales($db, $id){
            $result= $db->getReference("enterprises/".$id."/sucursales"."/")
            ->getValue();
            echo json_encode($result);
        }

        public static function obtenerSucursal($db, $idEnterprise, $idSucursal){
                $result= $db->getReference("enterprises/".$idEnterprise."/sucursales"."/".$idSucursal."/")
                ->getValue();
                echo json_encode($result);
        }

        public function getData(){
            $result['nameSucursal']=$this->nameSucursal;
            $result['emailSucursal']=$this->emailSucursal;
            $result['addressSucursal']=$this->addressSucursal;
            $result['phoneSucursal']=$this->phoneSucursal;
            $result['latitudeSucursal']=$this->latitudeSucursal;
            $result['longitudeSucursal']=$this->longitudeSucursal;
            $result['urlProfileImageSucursal']=$this->urlProfileImageSucursal;
            return $result;
        }
        /**
         * Get the value of nameSucursal
         */ 
        public function getNameSucursal()
        {
                return $this->nameSucursal;
        }

        /**
         * Set the value of nameSucursal
         *
         * @return  self
         */ 
        public function setNameSucursal($nameSucursal)
        {
                $this->nameSucursal = $nameSucursal;

                return $this;
        }

        /**
         * Get the value of emailSucursal
         */ 
        public function getEmailSucursal()
        {
                return $this->emailSucursal;
        }

        /**
         * Set the value of emailSucursal
         *
         * @return  self
         */ 
        public function setEmailSucursal($emailSucursal)
        {
                $this->emailSucursal = $emailSucursal;

                return $this;
        }

        /**
         * Get the value of addressSucursal
         */ 
        public function getAddressSucursal()
        {
                return $this->addressSucursal;
        }

        /**
         * Set the value of addressSucursal
         *
         * @return  self
         */ 
        public function setAddressSucursal($addressSucursal)
        {
                $this->addressSucursal = $addressSucursal;

                return $this;
        }

        /**
         * Get the value of phoneSucursal
         */ 
        public function getPhoneSucursal()
        {
                return $this->phoneSucursal;
        }

        /**
         * Set the value of phoneSucursal
         *
         * @return  self
         */ 
        public function setPhoneSucursal($phoneSucursal)
        {
                $this->phoneSucursal = $phoneSucursal;

                return $this;
        }

        /**
         * Get the value of latitudeSucursal
         */ 
        public function getLatitudeSucursal()
        {
                return $this->latitudeSucursal;
        }

        /**
         * Set the value of latitudeSucursal
         *
         * @return  self
         */ 
        public function setLatitudeSucursal($latitudeSucursal)
        {
                $this->latitudeSucursal = $latitudeSucursal;

                return $this;
        }

        /**
         * Get the value of longitudeSucursal
         */ 
        public function getLongitudeSucursal()
        {
                return $this->longitudeSucursal;
        }

        /**
         * Set the value of longitudeSucursal
         *
         * @return  self
         */ 
        public function setLongitudeSucursal($longitudeSucursal)
        {
                $this->longitudeSucursal = $longitudeSucursal;

                return $this;
        }

        /**
         * Get the value of urlProfileImageSucursal
         */ 
        public function getUrlProfileImageSucursal()
        {
                return $this->urlProfileImageSucursal;
        }

        /**
         * Set the value of urlProfileImageSucursal
         *
         * @return  self
         */ 
        public function setUrlProfileImageSucursal($urlProfileImageSucursal)
        {
                $this->urlProfileImageSucursal = $urlProfileImageSucursal;

                return $this;
        }
    }

?>