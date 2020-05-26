<?php
    class Promocion{
        private $idEnterprise;
        private $products;
        private $selectCategory;
        private $priceProduct;
        private $Discount;
        private $discountPromo;
        private $startPromo;
        private $finishPromo;
        private $sucursal;
        private $urlProductPromoImage;
        private $descriptionPromo;

        public function __construct(
            $idEnterprise,
            $products,
            $selectCategory,
            $priceProduct,
            $Discount,
            $discountPromo,
            $startPromo,
            $finishPromo,
            $sucursal,
            $urlProductPromoImage,
            $descriptionPromo
        )
        {
            $this->idEnterprise= $idEnterprise;
            $this->selectCategory= $selectCategory;
            $this->products= $products;
            $this->priceProduct= $priceProduct;
            $this->Discount= $Discount;
            $this->discountPromo= $discountPromo;
            $this->startPromo= $startPromo;
            $this->finishPromo= $finishPromo;
            $this->sucursal= $sucursal;
            $this->urlProductPromoImage= $urlProductPromoImage;
            $this->descriptionPromo= $descriptionPromo;
        }

        public function guardarPromocion($db){
            $promocion= $this->getData();
            $result= $db->getReference("promociones")->push($promocion);

            if ($result->getKey()!= null)
                    return '{"mensaje":"Promocion almacenada","key":"'.$result->getKey().'"}';
            else
                    return '{"mensaje":"Promocion no pudo ser almacenada"}';
        }

        public function obtenerPromociones($db){
                $result= $db->getReference("promociones")
                ->getValue();
                echo json_encode($result);
        }
        public function obtenerPromocion($db, $id){
                $result= $db->getReference("promociones")
                ->getChild($id)
                ->getValue();
                echo json_encode($result);
        }

        public function guardarPromocionFav($db, $id){
                $promocionfav= $this->getData();
                $result= $db->getReference("users/".$id."/promocionesFavoritas"."/")
                    ->push($promocionfav);
        
                if ($result->getKey()!= null)
                    return '{"mensaje":"Promoción favorita almacenada","key":"'.$result->getKey().'"}';
                else
                    return '{"mensaje":"Promoción favorita no pudo ser almacenada"}';
        }

        public static function obtenerPromocionesFav($db, $id){
                $result= $db->getReference("users/".$id."/promocionesFavoritas"."/")
                ->getValue();
                echo json_encode($result);
        }

        public function añadirAlCarrito($db, $id){
                $carrito= $this->getData();
                $result= $db->getReference("users/".$id."/carrito"."/")
                    ->push($carrito);
        
                if ($result->getKey()!= null)
                    return '{"mensaje":"Promoción al carrito almacenada","key":"'.$result->getKey().'"}';
                else
                    return '{"mensaje":"Promoción al carrito no pudo ser almacenada"}';
        }

        public static function eliminarPromoCarrito($db, $idUser, $idPromo){
                $db->getReference("users/".$idUser."/carrito"."/")
                    ->getChild($idPromo)
                    ->remove();
                echo '{"mensaje":"Se eliminó el elemento '.$idPromo.'"}';
            }

        public static function eliminarTodasPromoCarrito($db, $idUser){
                $db->getReference("users/".$idUser."/carrito"."/")
                    ->remove();
                echo '{"mensaje":"Se eliminó el eliminaron todas las promociones agregadas"}';
            }

        public static function obtenerPromocionesCarrito($db, $id){
                $result= $db->getReference("users/".$id."/carrito"."/")
                ->getValue();
                echo json_encode($result);
        }

        public function getData(){
            $result['idEnterprise']=$this->idEnterprise;
            $result['products']=$this->products; 
            $result['selectCategory']=$this->selectCategory;
            $result['priceProduct']=$this->priceProduct; 
            $result['Discount']=$this->Discount; 
            $result['discountPromo']=$this->discountPromo; 
            $result['startPromo']=$this->startPromo; 
            $result['finishPromo']=$this->finishPromo; 
            $result['sucursal']=$this->sucursal; 
            $result['urlProductPromoImage']=$this->urlProductPromoImage; 
            $result['descriptionPromo']=$this->descriptionPromo; 
            return $result;
        }
        
        /**
         * Get the value of products
         */ 
        public function getProducts()
        {
                return $this->products;
        }

        /**
         * Set the value of products
         *
         * @return  self
         */ 
        public function setProducts($products)
        {
                $this->products = $products;

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
         * Get the value of Discount
         */ 
        public function getDiscount()
        {
                return $this->Discount;
        }

        /**
         * Set the value of Discount
         *
         * @return  self
         */ 
        public function setDiscount($Discount)
        {
                $this->Discount = $Discount;

                return $this;
        }

        /**
         * Get the value of discountPromo
         */ 
        public function getDiscountPromo()
        {
                return $this->discountPromo;
        }

        /**
         * Set the value of discountPromo
         *
         * @return  self
         */ 
        public function setDiscountPromo($discountPromo)
        {
                $this->discountPromo = $discountPromo;

                return $this;
        }

        /**
         * Get the value of startPromo
         */ 
        public function getStartPromo()
        {
                return $this->startPromo;
        }

        /**
         * Set the value of startPromo
         *
         * @return  self
         */ 
        public function setStartPromo($startPromo)
        {
                $this->startPromo = $startPromo;

                return $this;
        }

        /**
         * Get the value of finishPromo
         */ 
        public function getFinishPromo()
        {
                return $this->finishPromo;
        }

        /**
         * Set the value of finishPromo
         *
         * @return  self
         */ 
        public function setFinishPromo($finishPromo)
        {
                $this->finishPromo = $finishPromo;

                return $this;
        }

        /**
         * Get the value of sucursal
         */ 
        public function getSucursal()
        {
                return $this->sucursal;
        }

        /**
         * Set the value of sucursal
         *
         * @return  self
         */ 
        public function setSucursal($sucursal)
        {
                $this->sucursal = $sucursal;

                return $this;
        }

        /**
         * Get the value of urlProductPromoImage
         */ 
        public function getUrlProductPromoImage()
        {
                return $this->urlProductPromoImage;
        }

        /**
         * Set the value of urlProductPromoImage
         *
         * @return  self
         */ 
        public function setUrlProductPromoImage($urlProductPromoImage)
        {
                $this->urlProductPromoImage = $urlProductPromoImage;

                return $this;
        }

        /**
         * Get the value of descriptionPromo
         */ 
        public function getDescriptionPromo()
        {
                return $this->descriptionPromo;
        }

        /**
         * Set the value of descriptionPromo
         *
         * @return  self
         */ 
        public function setDescriptionPromo($descriptionPromo)
        {
                $this->descriptionPromo = $descriptionPromo;

                return $this;
        }

        /**
         * Get the value of selectCategory
         */ 
        public function getSelectCategory()
        {
                return $this->selectCategory;
        }

        /**
         * Set the value of selectCategory
         *
         * @return  self
         */ 
        public function setSelectCategory($selectCategory)
        {
                $this->selectCategory = $selectCategory;

                return $this;
        }
    }
?>