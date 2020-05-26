<?php
class Usuario{
    private $name;
    private $lastName;
    private $birthday;
    private $gender;
    private $postal;
    private $country;
    private $state;
    private $address;
    private $phone;
    private $email;
    private $password;
    private $nameOwner;
    private $creditNumber;
    private $expirationDate;
    private $cvv;
    private $urlProfileImage;

    public function __construct(
        $name,
        $lastName,
        $birthday,
        $gender,
        $postal,
        $country,
        $state,
        $address,
        $phone,
        $email,
        $password,
        $nameOwner,
        $creditNumber,
        $expirationDate,
        $cvv,
        $urlProfileImage
    )
    {
        $this->name=$name;
        $this->lastName=$lastName;
        $this->birthday=$birthday;
        $this->gender=$gender;
        $this->postal=$postal;
        $this->country=$country;
        $this->state=$state;
        $this->address=$address;
        $this->phone=$phone;
        $this->email=$email;
        $this->password=$password;
        $this->nameOwner=$nameOwner;
        $this->creditNumber=$creditNumber;
        $this->expirationDate=$expirationDate;
        $this->cvv=$cvv;
        $this->urlProfileImage=$urlProfileImage;
    }

    public static function verificarUsuario($email, $password, $db){
        $result= $db->getReference('users')
                    ->getValue();
            
        foreach ($result as $key => $value) {
            if (($email==$result[$key]['email']) && (sha1($password)== $result[$key]['password'])) {
                setcookie("id", $key, time()+(60*60*24*40), "/");
                return $result[$key];
            }}
    }
    
    public static function obtenerUsuarios($db){
        $result= $db->getReference('users')
            ->getSnapshot()
            ->getValue();
            echo json_encode($result);
    }

    public static function obtenerUsuario($db, $id){
        $result= $db->getReference('users')
        ->getChild($id)
        ->getValue();
        echo json_encode($result);
    }

    public function actualizarUsuario($db, $id){
        $usuario= $db->getReference('users')
        ->getChild($id)
        ->getValue();
        $Usuario['name']= $this->name;
        $Usuario['lastName']= $this->lastName;
        $Usuario['birthday']= $this->birthday;
        $Usuario['gender']= $this->gender;
        $Usuario['postal']= $this->postal;
        $Usuario['country']= $this->country;
        $Usuario['state']= $this->state;
        $Usuario['address']= $this->address;
        $Usuario['phone']= $this->phone;
        $Usuario['email']= $this->email;
        $Usuario['password']=  sha1($this->password);
        $Usuario['nameOwner']= $this->nameOwner;
        $Usuario['creditNumber']= $this->creditNumber;
        $Usuario['expirationDate']= $this->expirationDate;
        $Usuario['cvv']= $this->cvv;
        $Usuario['urlProfileImage']= $this->urlProfileImage;
        $Usuario['empresasFavoritas']= $usuario['empresasFavoritas'];
        $Usuario['promocionesFavoritas']= $usuario['promocionesFavoritas'];

        $result= $db->getReference('users')
        ->getChild($id)
        ->set($Usuario);
        if($result->getKey()!= null)
            return '{"mensaje": "Registro actualizado","key":"'.$result->getKey().'"}';
        else
            return '{"mensaje":"Error al actualizar el registro"}';
    }

    //Retornar un arreglo asociativo con todos los atributos de la clase
    public function getData(){
        $result['name']= $this->name;
        $result['lastName']= $this->lastName;
        $result['birthday']= $this->birthday;
        $result['gender']= $this->gender;
        $result['postal']= $this->postal;
        $result['country']= $this->country;
        $result['state']= $this->state;
        $result['address']= $this->address;
        $result['phone']= $this->phone;
        $result['email']= $this->email;
        $result['password']=  sha1($this->password);
        $result['nameOwner']= $this->nameOwner;
        $result['creditNumber']= $this->creditNumber;
        $result['expirationDate']= $this->expirationDate;
        $result['cvv']= $this->cvv;
        $result['urlProfileImage']= $this->urlProfileImage;
        $result['empresasFavoritas']= [];
        $result['promocionesFavoritas']= [];
        return $result;
    }

    public function crearUsuario($db){
        session_start();
        $usuarios = $this->getData();
            $result= $db->getReference('users')
                        ->push($usuarios);
            if($result->getKey()!= null){
                $usuario= array(
                    "mensaje"=>"Registro almacenado",
                    "key"=>$result->getKey(),
                    "token"=>sha1(uniqid(rand(), true))
                );
                $_SESSION["token"]= $usuario["token"];
                setcookie("id", $usuario["key"], time()+(60*60*24*31), "/");
                setcookie("token", $usuario["token"], time()+ (60*60*24*31), "/");
                echo json_encode($usuario);

            }    
            else
                return '{"mensaje":"Error al guardar el registro"}';
    }

    public static function eliminarUsuario($db, $id){
        $db->getReference('users')
            ->getChild($id)
            ->remove();
        echo '{"mensaje":"Se eliminó el elemento '.$id.'"}';
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of lastName
     */ 
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */ 
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of birthday
     */ 
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set the value of birthday
     *
     * @return  self
     */ 
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get the value of gender
     */ 
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */ 
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of postal
     */ 
    public function getPostal()
    {
        return $this->postal;
    }

    /**
     * Set the value of postal
     *
     * @return  self
     */ 
    public function setPostal($postal)
    {
        $this->postal = $postal;

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
     * Get the value of address
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */ 
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of nameOwner
     */ 
    public function getNameOwner()
    {
        return $this->nameOwner;
    }

    /**
     * Set the value of nameOwner
     *
     * @return  self
     */ 
    public function setNameOwner($nameOwner)
    {
        $this->nameOwner = $nameOwner;

        return $this;
    }

    /**
     * Get the value of creditNumber
     */ 
    public function getCreditNumber()
    {
        return $this->creditNumber;
    }

    /**
     * Set the value of creditNumber
     *
     * @return  self
     */ 
    public function setCreditNumber($creditNumber)
    {
        $this->creditNumber = $creditNumber;

        return $this;
    }

    /**
     * Get the value of expirationDate
     */ 
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * Set the value of expirationDate
     *
     * @return  self
     */ 
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    /**
     * Get the value of cvv
     */ 
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * Set the value of cvv
     *
     * @return  self
     */ 
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;

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
}
?>