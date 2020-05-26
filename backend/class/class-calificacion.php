<?php
    class Calificacion{
        private $calificacion;

        public function __construct($calificacion)
        {
            $this->calificacion= $calificacion;            
        }

        public function guardarCalificacion($db, $idPromocion){
            $Puntuacion= $this->getData();
            $ref= "promociones/".$idPromocion."/puntuacion";
            $result= $db->getReference($ref)->push($Puntuacion);

            if ($result->getKey()!= null)
                    return '{"mensaje":"Puntuacion almacenada","key":"'.$result->getKey().'"}';
            else
                    return '{"mensaje":"Puntuacion no pudo ser almacenada"}';
        }

        public function getData(){
            $result['calificacion']= $this->calificacion;
            return $result;
        }

        /**
         * Get the value of calificacion
         */ 
        public function getCalificacion()
        {
                return $this->calificacion;
        }

        /**
         * Set the value of calificacion
         *
         * @return  self
         */ 
        public function setCalificacion($calificacion)
        {
                $this->calificacion = $calificacion;

                return $this;
        }
    }
?>