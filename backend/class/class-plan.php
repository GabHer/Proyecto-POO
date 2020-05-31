<?php
    class Plan{
        private $costo;
        private $duracion;
        private $descripcion;

        public function __construct(
            $costo,
            $duracion,
            $descripcion
        )
        {
            $this->costo= $costo;
            $this->duracion= $duracion;
            $this->descripcion= $descripcion;
        }

        public function guardarPlan($db){
            $plan = $this->getData();
            $result= $db->getReference('superAdmin/planes')
                    ->push($plan);

            if ($result->getKey()!= null)
                    return '{"mensaje":"Plan almacenado","key":"'.$result->getKey().'"}';
            else
                    return '{"mensaje":"Plan no pudo ser almacenado"}';
        }

        public function getData(){
            $result['costo']= $this->costo;
            $result['duracion']= $this->duracion;
            $result['descripcion']= $this->descripcion;

            return $result;

        }

        /**
         * Get the value of costo
         */ 
        public function getCosto()
        {
                return $this->costo;
        }

        /**
         * Set the value of costo
         *
         * @return  self
         */ 
        public function setCosto($costo)
        {
                $this->costo = $costo;

                return $this;
        }

        /**
         * Get the value of duracion
         */ 
        public function getDuracion()
        {
                return $this->duracion;
        }

        /**
         * Set the value of duracion
         *
         * @return  self
         */ 
        public function setDuracion($duracion)
        {
                $this->duracion = $duracion;

                return $this;
        }

        /**
         * Get the value of descripcion
         */ 
        public function getDescripcion()
        {
                return $this->descripcion;
        }

        /**
         * Set the value of descripcion
         *
         * @return  self
         */ 
        public function setDescripcion($descripcion)
        {
                $this->descripcion = $descripcion;

                return $this;
        }
    }
?>
