<?php
    class SuperAdmin{
        private $email;
        private $password;

        public function __construct(
            $email,
            $password
        )
        {
            $this->email= $email;
            $this->password= $password;
        }

        public function guardarSuperAdmin($db){
            $superAdmin = $this->getData();
            $result= $db->getReference('superAdmin')
                        ->push($superAdmin);

            echo '{"Mensaje":"Exito"}';
        }

        public static function verificarSuperAdmin($email, $password, $db){
            $result= $db->getReference('superAdmin')
                        ->getValue();
                
            foreach ($result as $key => $value) {
                if (($email==$result[$key]['email']) && (sha1($password)== $result[$key]['password'])) {
                    setcookie("id", $key, time()+(60*60*24*40), "/");
                    return $result[$key];
                }}
        }

        public function actualizarSuperAdmin($db, $id){
            $result= $db->getReference('superAdmin')
            ->getChild($id)
            ->set($this->getData());
    
            if($result->getKey()!= null)
                return '{"mensaje": "Registro actualizado","key":"'.$result->getKey().'"}';
            else
                return '{"mensaje":"Error al actualizar el registro"}';
        }

        public function getData(){
            $result['email'] = $this->email;
            $result['password'] = sha1($this->password);
            return $result;
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
    }
?>