<?php
    class database{
        protected $conn;
        protected $stmt;
        protected $sql;
        protected $table;

        function __construct(){       
//setting the connection to the database
              try{  
                $this->conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER, DB_PASS);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                $this->conn->exec('SET NAMES utf8');
                return true;
            }catch(PDOException $e){
                error_log(Date("M d, Y h:i:s a").':(DB CONNECTION) :'.$e->getMessage(), 3, ERROR_PATH. 'error.log');
                return false;
            }
        }

        function runQuery($sql){
        //To prepare table and superuser called from ../schema
            try{
                $this->stmt = $this->conn->prepare($sql);
                echo $this->stmt->execute();
                return true;
            }catch(PDOException $e){
                error_log(Date("M d, Y h:i:s a").':(Run query dm):'.$e->getMessage(), 3, ERROR_PATH. 'error.log');
                return false;
            }
        }

        function getDataFromQuery($sql){
        //reading the data
            try{
                $this->sql = $sql;
                $this->stmt = $this->conn->prepare($this-sql);
                $this->stmt->execute();
                $data = $this->stmt->fetchAll(PDO::FETCH_OBJ);
                return $data;
            }catch(PDOException $e){
                error_log(Date("M d, Y h:i:s a").':(Get data from query):'.$e->getMessage(), 3, ERROR_PATH. 'error.log');
                return false;
            }
        }
        protected function addData($data, $is_die = false){
            try{
            //generate query
                $this->sql = "INSERT INTO ";
                if (isset($this->table) && !empty($this->table)){
                    $this->sql .= $this->table;
                    $this->sql .= " SET ";
                }else{
                    throw new Exception("data cannot be stored without the table");
                }

                if (isset($data) && !empty($data)){
                    if (is_array($data)) {
                        $col = array();
                        foreach ($data as $columnname => $value) {
                            $col[] = $columnname .' = :' .$columnname;
                        }
                        $this->sql .= implode(', ', $col);
                    }else{
                        $this->sql .= $data;
                    }
                }else{
                    throw new Exception("Data cannot be empty");
                }
                if ($is_die == true) {
                    echo $this->sql;
                    exit();
                }
                
                $this->stmt = $this->conn->prepare($this->sql);
               
                if (isset($data) && !empty($data)){
                    if (is_array($data)) {
                        foreach ($data as $columnname => $value) {
                            if (is_int($value)){
                                $param = PDO::PARAM_INT;
                            }else if(is_bool($value)){
                                $param = PDO::PARAM_BOOL;
                            }else{
                                $param = PDO::PARAM_STR;
                            }
                            $this->stmt->bindValue(":".$columnname, $value, $param);
                           
                        }
                    }
                }else{
                    throw new Exception("Data cannot be empty");
                }

                return $this->stmt->execute();
            }catch(Exception  $e){
                error_log(Date("M d, Y h:i:s a").':(Add data):'.$e->getMessage(), 3, ERROR_PATH. 'error.log');
                return false;
            }catch(PDOException $e){
                error_log(Date("M d, Y h:i:s a").':(Add data):'.$e->getMessage(), 3, ERROR_PATH. 'error.log');
                return false;
            }
        }

        protected function getData($args, $is_die = false){
            try{
                $this->sql = "SELECT ";

                if (isset($args['fields']) && !empty($args['fields'])) {
                    if (is_array($args['fields'])) {
                        $this->sql .= implode(", ", $args['fields']);
                    }else{
                        $this->sql .= $args['fields']. " ";
                    }
                }else{
                    $this->sql .= " * ";
                }
                $this->sql .= " FROM ";
                if (isset($this->table) && !empty($this->table)){
                    $this->sql .= $this->table;
                }else{
                    throw new Exception("data cannot be stored without the table");
                }

                if (isset($args['where']) && !empty($args['where'])){
                    if (is_array($args['where'])) {
                        $this->sql .= " WHERE ";
                        if (isset($args['where']['and']) && !empty($args['where']['and'])){
                            $col_and = array();
                            foreach ($args['where']['and'] as $columnname => $value) {
                                $col_and[] = $columnname. "= :" .$columnname;
                            }
                            $this->sql .= implode(' and ', $col_and);
                        }   
                        if (isset($args['where']['or']) && !empty($args['where']['or'])){
                            $col_or = array();
                            foreach ($args['where']['or'] as $columnname => $value) {
                                $col_or[] = $columnname. "= :" .$columnname;
                            }
                            $this->sql .= implode(' or ', $col_or);
                        }   

                    }else{
                        $this->sql .= $args['where'];
                }


                if (isset($args['order']) && !empty($args['order'])) {
                    if(is_array($args['order'])){
                        $this->sql .= " order by  ".$args['order']['columnname']." ".$args['order']['orderType']." ";
                    }else if ($args['order'] == 'DECS') {
                        $this->sql .= " order by id DESC";
                    }else{
                        $this->sql .= " order by id ASC";
                    }
                }else {
                    $this->sql .= " order by id DESC";
                }

                if (isset($args['limit']) && !empty($args['limit'])) {
                    $this->sql .= " LIMIT ".$args['limit']['offset']. ", ".$args['limit']['no_of_data'];
                }
                if($is_die){
                    echo $this->sql;
                    exit();
                }

                $this->stmt = $this->conn->prepare($this->sql);


                if (isset($args['where']) && !empty($args['where'])){
                    if (is_array($args['where'])) {
                        $this->sql .= " WHERE ";
                        if (isset($args['where']['and']) && !empty($args['where']['and'])){
                            foreach ($args['where']['and'] as $columnname => $value) {
                                if (is_int($value)){
                                    $param = PDO::PARAM_INT;
                                }else if(is_bool($value)){
                                    $param = PDO::PARAM_BOOL;
                                }else{
                                    $param = PDO::PARAM_STR;
                                }
                                $this->stmt->bindValue(":".$columnname, $value, $param);
                            }
                        }
                        }   
                        if (isset($args['where']['or']) && !empty($args['where']['or'])){
                            foreach ($args['where']['or'] as $columnname => $value) {
                                if (is_int($value)){
                                    $param = PDO::PARAM_INT;
                                }else if(is_bool($value)){
                                    $param = PDO::PARAM_BOOL;
                                }else{
                                    $param = PDO::PARAM_STR;
                                }
                                $this->stmt->bindValue(":".$columnname, $value, $param);
                            }
                        }   
                    }

                }
                $this->stmt->execute();
                $data = $this->stmt->fetchAll(PDO::FETCH_OBJ);
                return $data;


            }catch(Exception  $e){
                error_log(Date("M d, Y h:i:s a").':(Add data):'.$e->getMessage(), 3, ERROR_PATH. 'error.log');
                return false;
            }catch(PDOException $e){
                error_log(Date("M d, Y h:i:s a").':(Add data):'.$e->getMessage(), 3, ERROR_PATH. 'error.log');
                return false;
            }
        }

        protected function updataData($data, $args, $is_die = false){
            try{
                $this->sql = "UPDATE ";
                if (isset($this->table) && !empty($this->table)){
                    $this->sql .= $this->table;
                    $this->sql .= " SET ";
                }else{
                    throw new Exception("data cannot be stored without the table");
                }

                if (isset($data) && !empty($data)){
                    if (is_array($data)) {
                        $col = array();
                        foreach ($data as $columnname => $value) {
                            $col[] = $columnname .' = :' .$columnname."s";
                        }
                        $this->sql .= implode(', ', $col);
                    }else{
                        $this->sql .= $data;
                    }
                }else{
                    throw new Exception("Data cannot be empty");
                }
                if (isset($args['where']) && !empty($args['where'])){
                    if (is_array($args['where'])) {
                        $this->sql .= " WHERE ";
                        if (isset($args['where']['and']) && !empty($args['where']['and'])){
                            $col_and = array();
                            foreach ($args['where']['and'] as $columnname => $value) {
                                $col_and[] = $columnname. "= :" .$columnname;
                            }
                            $this->sql .= implode(' and ', $col_and);
                        }   
                        if (isset($args['where']['or']) && !empty($args['where']['or'])){
                            $col_or = array();
                            foreach ($args['where']['or'] as $columnname => $value) {
                                $col_or[] = $columnname. "= :" .$columnname;
                            }
                            $this->sql .= implode(' or ', $col_or);
                        }   

                    }else{
                        $this->sql .= $args['where'];
                }

                if ($is_die) {
                    echo $this->sql;
                    exit();
                }

                $this->stmt = $this->conn->prepare($this->sql); 
               
                if (isset($data) && !empty($data)){
                    if (is_array($data)) {
                        foreach ($data as $columnname => $value) {
                            if (is_int($value)){
                                $param = PDO::PARAM_INT;
                            }else if(is_bool($value)){
                                $param = PDO::PARAM_BOOL;
                            }else{
                                $param = PDO::PARAM_STR;
                            }
                            $this->stmt->bindValue(":".$columnname."s", $value, $param);
                        }
                    }
                }else{
                    throw new Exception("Data cannot be empty");
                }

                if (isset($args['where']) && !empty($args['where'])){
                    if (is_array($args['where'])) {
                        $this->sql .= " WHERE ";
                        if (isset($args['where']['and']) && !empty($args['where']['and'])){
                            foreach ($args['where']['and'] as $columnname => $value) {
                                if (is_int($value)){
                                    $param = PDO::PARAM_INT;
                                }else if(is_bool($value)){
                                    $param = PDO::PARAM_BOOL;
                                }else{
                                    $param = PDO::PARAM_STR;
                                }
                                $this->stmt->bindValue(":".$columnname, $value, $param);
                            }
                        }
                        }   
                        if (isset($args['where']['or']) && !empty($args['where']['or'])){
                            foreach ($args['where']['or'] as $columnname => $value) {
                                if (is_int($value)){
                                    $param = PDO::PARAM_INT;
                                }else if(is_bool($value)){
                                    $param = PDO::PARAM_BOOL;
                                }else{
                                    $param = PDO::PARAM_STR;
                                }
                                $this->stmt->bindValue(":".$columnname, $value, $param);
                            }
                        }   
                    }

                }
                $this->stmt->execute();
                return true;
            
            
            
            }catch(Exception  $e){
                error_log(Date("M d, Y h:i:s a").':(Add data):'.$e->getMessage(), 3, ERROR_PATH. 'error.log');
                return false;
            }catch(PDOException $e){
                error_log(Date("M d, Y h:i:s a").':(Add data):'.$e->getMessage(), 3, ERROR_PATH. 'error.log');
                return false;
            }
        }

        protected function deleteData($args, $is_die = false){
            try{
                $this->sql = "DELETE FROM ";

                
                if (isset($this->table) && !empty($this->table)){
                    $this->sql .= $this->table;
                }else{
                    throw new Exception("data cannot be stored without the table");
                }

                if (isset($args['where']) && !empty($args['where'])){
                    if (is_array($args['where'])) {
                        $this->sql .= " WHERE ";
                        if (isset($args['where']['and']) && !empty($args['where']['and'])){
                            $col_and = array();
                            foreach ($args['where']['and'] as $columnname => $value) {
                                $col_and[] = $columnname. "= :" .$columnname;
                            }
                            $this->sql .= implode(' and ', $col_and);
                        }   
                        if (isset($args['where']['or']) && !empty($args['where']['or'])){
                            $col_or = array();
                            foreach ($args['where']['or'] as $columnname => $value) {
                                $col_or[] = $columnname. "= :" .$columnname;
                            }
                            $this->sql .= implode(' or ', $col_or);
                        }   

                    }else{
                        $this->sql .= $args['where'];
                }


                if($is_die){
                    echo $this->sql;
                    exit();
                }

                $this->stmt = $this->conn->prepare($this->sql);


                if (isset($args['where']) && !empty($args['where'])){
                    if (is_array($args['where'])) {
                        $this->sql .= " WHERE ";
                        if (isset($args['where']['and']) && !empty($args['where']['and'])){
                            foreach ($args['where']['and'] as $columnname => $value) {
                                if (is_int($value)){
                                    $param = PDO::PARAM_INT;
                                }else if(is_bool($value)){
                                    $param = PDO::PARAM_BOOL;
                                }else{
                                    $param = PDO::PARAM_STR;
                                }
                                $this->stmt->bindValue(":".$columnname, $value, $param);
                            }
                        }
                        }   
                        if (isset($args['where']['or']) && !empty($args['where']['or'])){
                            foreach ($args['where']['or'] as $columnname => $value) {
                                if (is_int($value)){
                                    $param = PDO::PARAM_INT;
                                }else if(is_bool($value)){
                                    $param = PDO::PARAM_BOOL;
                                }else{
                                    $param = PDO::PARAM_STR;
                                }
                                $this->stmt->bindValue(":".$columnname, $value, $param);
                            }
                        }   
                    }

                }
                return $this->stmt->execute();


            }catch(Exception  $e){
                error_log(Date("M d, Y h:i:s a").':(Add data):'.$e->getMessage(), 3, ERROR_PATH. 'error.log');
                return false;
            }catch(PDOException $e){
                error_log(Date("M d, Y h:i:s a").':(Add data):'.$e->getMessage(), 3, ERROR_PATH. 'error.log');
                return false;
            }
        }
    }





// $args = array(
			// 	'fields' => array('id','username','email','password'),
			// 	'where' => array(
			// 			'and' => array(
			// 				columnname => value,
			// 				columnname => value,	
			// 			),
			// 			'or' => array(
			// 				columnname => value,
			// 				columnname => value,	
			// 			)
			// 		)
			// 	'order' => array(
					// 	'columnname'=>'view',
					// 	'orderType'=>'ASC|DESC'
					// ),
			// 	'limit' => array(
			// 				'offset' => 6,
			// 				'no_of_data' =>7	
			// 	 		),

            // );
            ?>