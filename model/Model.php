<?php
namespace Model;
use PDO;
class Model
{

		const HOST 					="localhost";
        const DB 					="ah_matibabu";
        const USERNAME 				="root";
        const PASSWORD 				="";

        protected $routerTakeRoute	;
        private $lastId;


        public function __construct(){

        }
        private function getConnection(){#METHOD OF CONNECTION TO DB

            $username 		= self::USERNAME;
            $password 		= self::PASSWORD;
            $host 			= self::HOST;
            $db 			= self::DB;

		    try{
		        $connection = new PDO("mysql:dbname=$db;host=$host", $username, $password);

		        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		    }catch(PDOExeption $e){

		        die('Error' . $e->getMessage());
		    }
            
            return $connection;

        }#END METHOD

        protected function lastId()
        {
            return $this->lastId;
        }

        
        protected function queryList($sql, $args){#METHOD TO MAKE QUERIES( UPDATE,INSERT,DELETE)
            $connection     =$this->getConnection();
            $stmt           =$connection->prepare($sql);
            $stmt->execute($args);
            $this->lastId   =$connection->lastInsertId();
            return $stmt;
        }#END METHODE

        protected function AsObj($query){#RETURN THE QUERY RESULTS AS PDO OBJECT

        	return $query->fetch(PDO::FETCH_OBJ);
        }#END METHOD

        protected function cell_count($table, $field_name, $field_value){

            $query  =$this->queryList("SELECT * FROM $table WHERE $field_name =:field_value",["field_value"  =>$field_value]);

            $queryRes =$this->AsCount($query);
            return $queryRes;
        }

        protected function AsCount($query){#COUNT NUMBER OF RESULT FOUNDED

        	return $query->rowCount();
        }#END METHOD

        protected function AsTabIndex($query){#RETURN RESULT OF QUERY AS PDO ARRAY INDEX

        	return $query->fetchAll();
        }#END METHOD

        protected function AsCurrent($query){#RETURN RESULT AS CURRENT PDO OBJECT

        	return current($query->fetchAll(PDO::FETCH_OBJ));
        }#END METHOD

        protected function AsAll($query){#ALL RESULTS AS OBJECTS

            return $query->fetchAll(PDO::FETCH_OBJ);
        }#END METHOD

        protected function close($query)
        {
            $query->closeCursor();
        }

		protected function tableExists($tableName) {#IS THE TABLE PROVIDED EXISTS?

			$results =$this->queryList("SHOW TABLES LIKE '$tableName'",null);

			return $this->AsObj($results) ? true : false;
		    
		}#END METHOD

        protected function fieldExists($tableName,$fieldName){

            if (!$this->tableExists($tableName))return false;

            $query =$this->queryList("

                    SELECT * FROM INFORMATION_SCHEMA.COLUMNS
                    WHERE TABLE_NAME =:tableName AND COLUMN_NAME =:fieldName",
                    ["tableName"=>$tableName,"fieldName"=>$fieldName]

                    );

            $result =$this->AsCount($query);
            
            return $result ? true : false;
        }


}#END CLASS
