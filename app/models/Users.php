<?php
	namespace app\models;
	use app\core\QModel;

    trait UserMixin{
        public function verify_password($password){
            return password_verify($password, $this->password_hash);
        }
        public function generate_password_hash($password){
            
            $this->__set__('password_hash', password_hash($password, PASSWORD_PKBDF2,[
                'salt'=> "parrot",
                'iterations'=>1000,
                'algo'=>PASSWORD_HASH_ALGO_SHA256
            ]));
            return;
        }
    }
	class Users extends QModel{
        use UserMixin;
        public string $username;
        public string $email;
        public string $is_active;
        public string $password_hash;
        public string $__tablename__ = 'users';
        public function __construct(){

            $this->username = "VARCHAR(200) ";
            $this->email = " VARCHAR(60) UNIQUE ";
            $this->password_hash = "VARCHAR(100) UNIQUE";
            $this->is_active = "BOOLEAN DEFAULT FALSE ";
            parent::__construct();


        }
   }