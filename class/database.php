<?php
    class database{
        protected $conn;
        protected $stmt;
        protected $sql;
        protected $table;

        function __construct(){
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

    }

?>