<?php
	namespace app\auth;
	use app\core\QDatabase;
	use app\models\Users;
	use app\core\QController;

	class AuthRegister extends QController{
		public $db;
        public $model;
        public $errors =[];
        public function __construct(){

        }
        public function get(){
            return $this->get_template('auth/register');
        }
        public function post(){
            $this->errors = [];
            if($this->route->request['requestMethod']=="POST"){
                foreach($this->route->form as $key => $value){
                    if(empty($value)){
                        $this->errors[$key] ="Field Should not be empty!";
                    }
                }
                if(count($this->errors) == 0){
                    $user = new Users(
                        ...$this->form
                    );
                    $this->db->session->add($user);
                    $this->db->commit();
                    return header("Location:".$this->route->url_for('auth_login'));
                }
            }
        	return $this->get_template('auth/register');
        }  
   }