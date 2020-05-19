<?php
class Empresa{
    private $nameEnterprise;
    private $descriptionEnterprise;
    private $fundationDate;
    private $emailEnterprise;
    private $passwordEnterprise;
    private $postalCode;
    private $country;
    private $state;
    private $addressEnterprise;
    private $phoneNumberEnterprise;
    private $latitute;
    private $longitude;
    private $urlProfileImage;
    private $urlBanner;

    public function __construct(
        $nameEnterprise,
        $descriptionEnterprise,
        $fundationDate,
        $emailEnterprise,
        $passwordEnterprise,
        $postalCode,
        $country,
        $state,
        $addressEnterprise,
        $phoneNumberEnterprise,
        $latitute,
        $longitude,
        $urlProfileImage,
        $urlBanner
    ){
        $this->nameEnterprise= $nameEnterprise;
        $this->descriptionEnterprise= $descriptionEnterprise;
        $this->fundationDate= $fundationDate;
        $this->emailEnterprise= $emailEnterprise;
        $this->passwordEnterprise= $passwordEnterprise;
        $this->postalCode= $postalCode;
        $this->country= $country;
        $this->state= $state;
        $this->addressEnterprise= $addressEnterprise;
        $this->phoneNumberEnterprise= $phoneNumberEnterprise;
        $this->latitute= $latitute;
        $this->longitude= $longitude;
        $this->urlProfileImage= $urlProfileImage;
        $this->urlBanner= $urlBanner;
    }

    public static function verificarEmpresa($email, $password, $db){
        $result= $db->getReference('enterprises')
                    ->getValue();
        foreach ($result as $key => $value) {
            if (($email==$result[$key]['emailEnterprise']) && (sha1($password)== $result[$key]['passwordEnterprise'])) {
                setcookie("id", $key, time()+(60*60*24*40), "/");
                setcookie("latitute", $result[$key]['latitute'], time()+(60*60*24*40), "/");
                setcookie("longitude", $result[$key]['longitude'], time()+(60*60*24*40), "/");
                return $result[$key];
            }}
    }

    public function crearEmpresa($db){
        session_start();
        $empresas = $this->getData();
        $result= $db->getReference('enterprises')
                    ->push($empresas);
        if($result->getKey()!= null){
        $empresa= array(
            "mensaje"=>"Registro almacenado",
            "key"=>$result->getKey(),
            "token"=>sha1(uniqid(rand(), true))
        );
        $_SESSION["token"]= $empresa["token"];
        setcookie("id", $empresa["key"], time()+(60*60*24*31), "/");
        setcookie("token", $empresa["token"], time()+ (60*60*24*31), "/");
        setcookie("latitute", $result['latitute'], time()+(60*60*24*40), "/");
        setcookie("longitude", $result['longitude'], time()+(60*60*24*40), "/");
        echo json_encode($empresa);
    }
        else
            return '{"mensaje":"Error al guardar la empresa"}';
    }

    public static function obtenerEmpresas($db){
        $result= $db->getReference('enterprises')
            ->getSnapshot()
            ->getValue();
            echo json_encode($result);
    }

    public static function obtenerEmpresa($db, $id){
        $result= $db->getReference('enterprises')
        ->getChild($id)
        ->getValue();
        echo json_encode($result);
    }

    public function actualizarEmpresa($db, $id){
        $empresa= $db->getReference('enterprises')
        ->getChild($id)
        ->getValue();
        $Empresa['nameEnterprise']= $this->nameEnterprise;
        $Empresa['descriptionEnterprise']= $this->descriptionEnterprise;
        $Empresa['fundationDate']= $this->fundationDate;
        $Empresa['emailEnterprise']= $this->emailEnterprise;
        $Empresa['passwordEnterprise']= sha1($this->passwordEnterprise);
        $Empresa['postalCode']= $this->postalCode;
        $Empresa['country']= $this->country;
        $Empresa['state']= $this->state;
        $Empresa['addressEnterprise']= $this->addressEnterprise;
        $Empresa['phoneNumberEnterprise']= $this->phoneNumberEnterprise;
        $Empresa['latitute']= $this->latitute;
        $Empresa['longitude']= $this->longitude;
        $Empresa['urlProfileImage']= $this->urlProfileImage;
        $Empresa['urlBanner']= $this->urlBanner;
        $Empresa['sucursales']= $empresa["sucursales"];
        $Empresa['productos']= $empresa["productos"];

        $result= $db->getReference('enterprises')
        ->getChild($id)
        ->set($Empresa);
        setcookie("latitute", $result['latitute'], time()+(60*60*24*40), "/");
        setcookie("longitude", $result['longitude'], time()+(60*60*24*40), "/");
        if($result->getKey()!= null)
            return '{"mensaje": "Empresa actualizado","key":"'.$result->getKey().'"}';
        else
            return '{"mensaje":"Error al actualizar la Empresa"}';
    }

    //Retornar un arreglo asociativo con todos los atributos de la clase
    public function getData(){
        $result['nameEnterprise']= $this->nameEnterprise;
        $result['descriptionEnterprise']= $this->descriptionEnterprise;
        $result['fundationDate']= $this->fundationDate;
        $result['emailEnterprise']= $this->emailEnterprise;
        $result['passwordEnterprise']= sha1($this->passwordEnterprise);
        $result['postalCode']= $this->postalCode;
        $result['country']= $this->country;
        $result['state']= $this->state;
        $result['addressEnterprise']= $this->addressEnterprise;
        $result['phoneNumberEnterprise']= $this->phoneNumberEnterprise;
        $result['latitute']= $this->latitute;
        $result['longitude']= $this->longitude;
        $result['urlProfileImage']= $this->urlProfileImage;
        $result['urlBanner']= $this->urlBanner;
        $result['sucursales']= [];
        return $result;
    }

    public static function eliminarEmpresa($db, $id){
        $db->getReference('enterprises')
            ->getChild($id)
            ->remove();
        echo '{"mensaje":"Se eliminó el elemento '.$id.'"}';
    }

    /**
     * Get the value of nameEnterprise
     */ 
    public function getNameEnterprise()
    {
        return $this->nameEnterprise;
    }

    /**
     * Set the value of nameEnterprise
     *
     * @return  self
     */ 
    public function setNameEnterprise($nameEnterprise)
    {
        $this->nameEnterprise = $nameEnterprise;

        return $this;
    }

    /**
     * Get the value of descriptionEnterprise
     */ 
    public function getDescriptionEnterprise()
    {
        return $this->descriptionEnterprise;
    }

    /**
     * Set the value of descriptionEnterprise
     *
     * @return  self
     */ 
    public function setDescriptionEnterprise($descriptionEnterprise)
    {
        $this->descriptionEnterprise = $descriptionEnterprise;

        return $this;
    }

    /**
     * Get the value of fundationDate
     */ 
    public function getFundationDate()
    {
        return $this->fundationDate;
    }

    /**
     * Set the value of fundationDate
     *
     * @return  self
     */ 
    public function setFundationDate($fundationDate)
    {
        $this->fundationDate = $fundationDate;

        return $this;
    }

    /**
     * Get the value of emailEnterprise
     */ 
    public function getEmailEnterprise()
    {
        return $this->emailEnterprise;
    }

    /**
     * Set the value of emailEnterprise
     *
     * @return  self
     */ 
    public function setEmailEnterprise($emailEnterprise)
    {
        $this->emailEnterprise = $emailEnterprise;

        return $this;
    }

    /**
     * Get the value of passwordEnterprise
     */ 
    public function getPasswordEnterprise()
    {
        return $this->passwordEnterprise;
    }

    /**
     * Set the value of passwordEnterprise
     *
     * @return  self
     */ 
    public function setPasswordEnterprise($passwordEnterprise)
    {
        $this->passwordEnterprise = $passwordEnterprise;

        return $this;
    }

    /**
     * Get the value of postalCode
     */ 
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set the value of postalCode
     *
     * @return  self
     */ 
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get the value of country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */ 
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of state
     */ 
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @return  self
     */ 
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get the value of addressEnterprise
     */ 
    public function getAddressEnterprise()
    {
        return $this->addressEnterprise;
    }

    /**
     * Set the value of addressEnterprise
     *
     * @return  self
     */ 
    public function setAddressEnterprise($addressEnterprise)
    {
        $this->addressEnterprise = $addressEnterprise;

        return $this;
    }

    /**
     * Get the value of phoneNumberEnterprise
     */ 
    public function getPhoneNumberEnterprise()
    {
        return $this->phoneNumberEnterprise;
    }

    /**
     * Set the value of phoneNumberEnterprise
     *
     * @return  self
     */ 
    public function setPhoneNumberEnterprise($phoneNumberEnterprise)
    {
        $this->phoneNumberEnterprise = $phoneNumberEnterprise;

        return $this;
    }

    /**
     * Get the value of latitute
     */ 
    public function getLatitute()
    {
        return $this->latitute;
    }

    /**
     * Set the value of latitute
     *
     * @return  self
     */ 
    public function setLatitute($latitute)
    {
        $this->latitute = $latitute;

        return $this;
    }

    /**
     * Get the value of longitude
     */ 
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set the value of longitude
     *
     * @return  self
     */ 
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get the value of urlProfileImage
     */ 
    public function getUrlProfileImage()
    {
        return $this->urlProfileImage;
    }

    /**
     * Set the value of urlProfileImage
     *
     * @return  self
     */ 
    public function setUrlProfileImage($urlProfileImage)
    {
        $this->urlProfileImage = $urlProfileImage;

        return $this;
    }

    /**
     * Get the value of urlBanner
     */ 
    public function getUrlBanner()
    {
        return $this->urlBanner;
    }

    /**
     * Set the value of urlBanner
     *
     * @return  self
     */ 
    public function setUrlBanner($urlBanner)
    {
        $this->urlBanner = $urlBanner;

        return $this;
    }
}
?>