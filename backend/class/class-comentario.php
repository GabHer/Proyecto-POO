<?php
    class Comentario{
        private $idUsuario;
        private $comentario;

        public function __construct(
            $idUsuario,
            $comentario
        )
        {
            $this->idUsuario = $idUsuario;
            $this->comentario = $comentario;
        }

        public function guardarComentario($db, $idPromocion){
            $comentario= $this->getData();
            $ref= "promociones/".$idPromocion."/comentarios";
            $result= $db->getReference($ref)->push($comentario);

            if ($result->getKey()!= null)
                    return '{"mensaje":"Comentario almacenado","key":"'.$result->getKey().'"}';
            else
                    return '{"mensaje":"Comentario no pudo ser almacenado"}';
        }

        public static function obtenerComentarios($db, $idPromocion){
            $result= $db->getReference("promociones/".$idPromocion."/comentarios"."/")
                        ->getValue();
                echo json_encode($result);
        }

        public static function eliminarComentario($db, $idPromocion, $idComentario, $idUsuario){
                $result= $db->getReference("promociones/".$idPromocion."/comentarios"."/".$idComentario)
                        ->getValue();
                if($result['idUsuario']==$idUsuario){
                        $db->getReference("promociones/".$idPromocion."/comentarios"."/")
                        ->getChild($idComentario)
                        ->remove();
                        echo '{"mensaje":"Se eliminó el elemento '.$idComentario.'"}';
                }else{
                        echo '{"mensaje":"El usuario no puede eliminar el elemento '.$idComentario.'"}';
                }
        }

        public function getData(){
            $result['idUsuario'] = $this->idUsuario;
            $result['comentario'] = $this->comentario;
            return $result;
        }

        /**
         * Get the value of idUsuario
         */ 
        public function getIdUsuario()
        {
                return $this->idUsuario;
        }

        /**
         * Set the value of idUsuario
         *
         * @return  self
         */ 
        public function setIdUsuario($idUsuario)
        {
                $this->idUsuario = $idUsuario;

                return $this;
        }

        /**
         * Get the value of comentario
         */ 
        public function getComentario()
        {
                return $this->comentario;
        }

        /**
         * Set the value of comentario
         *
         * @return  self
         */ 
        public function setComentario($comentario)
        {
                $this->comentario = $comentario;

                return $this;
        }
    }
?>