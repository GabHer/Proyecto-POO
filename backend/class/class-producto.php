<?php
    class Producto{
        private $nameProduct;
        private $priceProduct;
        private $descriptionProduct;
        private $urlProductImage;

        public function __construct(
            $nameProduct,
            $priceProduct,
            $descriptionProduct,
            $urlProductImage
        )
        {
            $this->nameProduct= $nameProduct;
            $this->priceProduct= $priceProduct;
            $this->descriptionProduct= $descriptionProduct;
            $this->urlProductImage= $urlProductImage;
        }

        public function guardarProducto($db, $idEnterprise){
                $producto= $this->getData();
                $ref= "enterprises/".$idEnterprise."/productos";
                $result= $db->getReference($ref)->push($producto);

                if ($result->getKey()!= null)
                        return '{"mensaje":"Producto almacenado","key":"'.$result->getKey().'"}';
                else
                        return '{"mensaje":"Producto no pudo ser almacenado"}';
        }

        public function obtenerProductos($db, $idEnterprise){
                $result= $db->getReference("enterprises/".$idEnterprise."/productos"."/")
                        ->getValue();
                echo json_encode($result);
        }

        public function obtenerProducto($db, $idEnterprise, $idProducto){
                $result= $db->getReference("enterprises/".$idEnterprise."/productos"."/".$idProducto."/")
                        ->getValue();
                echo json_encode($result);
        }

        public function getData(){
                $result['nameProduct']=$this->nameProduct;
                $result['priceProduct']=$this->priceProduct;
                $result['descriptionProduct']=$this->descriptionProduct;
                $result['urlProductImage']=$this->urlProductImage;
                return $result;
        }
        /**
         * Get the value of nameProduct
         */ 
        public function getNameProduct()
        {
                return $this->nameProduct;
        }

        /**
         * Set the value of nameProduct
         *
         * @return  self
         */ 
        public function setNameProduct($nameProduct)
        {
                $this->nameProduct = $nameProduct;

                return $this;
        }

        /**
         * Get the value of priceProduct
         */ 
        public function getPriceProduct()
        {
                return $this->priceProduct;
        }

        /**
         * Set the value of priceProduct
         *
         * @return  self
         */ 
        public function setPriceProduct($priceProduct)
        {
                $this->priceProduct = $priceProduct;

                return $this;
        }

        /**
         * Get the value of descriptionProduct
         */ 
        public function getDescriptionProduct()
        {
                return $this->descriptionProduct;
        }

        /**
         * Set the value of descriptionProduct
         *
         * @return  self
         */ 
        public function setDescriptionProduct($descriptionProduct)
        {
                $this->descriptionProduct = $descriptionProduct;

                return $this;
        }

        /**
         * Get the value of urlProductImage
         */ 
        public function getUrlProductImage()
        {
                return $this->urlProductImage;
        }

        /**
         * Set the value of urlProductImage
         *
         * @return  self
         */ 
        public function setUrlProductImage($urlProductImage)
        {
                $this->urlProductImage = $urlProductImage;

                return $this;
        }

       
    }
?>