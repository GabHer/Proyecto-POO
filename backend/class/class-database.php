<?php
    require_once __DIR__.'../../vendor/autoload.php';
    use Kreait\Firebase\Factory;

    class Database{
        private $keyFile='../secret/bd-find-c05180e5350a.json';
        private $URI='https://bd-find.firebaseio.com/';
        private $db;
        public function __construct()
        {
            $firebase = (new Factory)
                ->withServiceAccount($this->keyFile)
                ->withDatabaseUri($this->URI);

            $this->db = $firebase->createDatabase();

        }

        public function getDB(){
            return $this->db;
        }
    }

?>