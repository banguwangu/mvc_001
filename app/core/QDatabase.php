<?php
	namespace app\core;
	use PDO;
	class QDatabase{
        public $session;
        public $query;
        private $SQLstmt;
        private $model;
        private $abstractor;
        private $SQLargs;
        public function __construct($dbName){

            $dsn = "mysql:host=localhost;dbname=$dbName;port=3307;charset=utf8mb4";

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $this->abstractor = new PDO($dsn, 'root', 'admin', $options);

            $this->session = $this->abstractor;;

        }
        public function query($model){
            $sqlStmt = "SELECT * FROM `".$model->__tablename__."`";
            $this->SQLstmt = $sqlStmt;
            $this->model = $model;
            return $this;
        }
        public function first(){
            if ($this->SQLargs == null){
                $stmt =  $this->session->query($this->SQLstmt." FIRST_VALUE");
            }else{
                $stmt = $this->session->prepare($this->SQLstmt);
                foreach($this->SQLargs as $key => $value){
                    $stmt->bindValue(':'.$key, $value);
                }
                $stmt->execute();

            }
            $this->SQLstmt = null;
            $model = $this->model;
            try{
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                if(count($result) == 0){
                    return null;
                }
                foreach($result[0] as $key => $value){
                    $model->{$key} = $value;
                }
                return $model;
            }catch(\Exception $e){
                return null;
            }
            
        }
        public function filter(...$args){
            $this->SQLargs = $args;
            foreach($args as $key => $value){
                $this->SQLstmt .= " WHERE `".$key."` = :".$key;
            }
            return $this;
        }
    }