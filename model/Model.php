<?php
namespace Model;
use PDO;
class Model
{

		const HOST 					="localhost";
        const DB 					="ah_viotube";
        const USERNAME 				="root";
        const PASSWORD 				="";

        const USERS_TABLE 			="users";
        const EVENTS_TABLE 			="a_events";
        const JOURNALS_TABLE 		="a_journals";

        const ROUTE_USER_PROFIL 	="userprofil";
        const ROUTE_EVENT 			="event";
        const ROUTE_JOURNAL 		="journal";

        const IN_USER_FIELD 		="row_profil_name";
        const IN_EVENT_FIELD 		="raw_event_name";
        const IN_JOURNAL_FIELD 		="raw_journal_name";

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
