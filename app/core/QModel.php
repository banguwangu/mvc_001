<?php
	
    namespace app\core;
    
    use app\core\QDatabase;

	abstract class QModel{
        public string $id;
        public function __construct(){

            $this->id = " INT(11) PRIMARY KEY AUTO_INCREMENT ";
        }
        public function createTable(){
            $stmt = "
                CREATE TABLE IF NOT EXISTS `".strtolower($this->__tablename__)."`(
                    ".$this->getColumns()."
                )
            ";
            return $stmt;
        }
        private function getColumns(){
            $attrs = $this->getColumnsList();
            $cols_stmt = '' ;
            $cols =  [];
            foreach (array_keys($attrs) as $key => $value) {
                $cols[] = "`".$value."` ".$this->{$value};
            }
            $cols_stmt .= implode(',', $cols);         

            return $cols_stmt;
        }
        public function getColumnsList(){
            $list =  [];
            foreach (get_object_vars($this) as $key => $value) {
                if($key != '__tablename__'){
                    $list[$key] = $value;
                }
            }
            return $list;
        }
        public function query(){
            return $this;
        }
        public function fetchAll(){

        }
        public function save(){

        }
   }