<?php
	namespace app\auth;
	use app\core\QDatabase;
	use app\models\Users;
	use app\core\QController;

	class AuthRegister extends QController{
		public $db;
        public $model;
        public function __construct(){

        }
        public function get(){
            return $this->get_template('auth/register');
        }
        public function post(){
        	echo "You have successfully Signed In ";
        }
   }