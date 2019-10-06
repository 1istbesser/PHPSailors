<?php
declare(strict_types=1);
namespace PHPSailors\Core;

class Service{
    private $database;
    private $connection;

    public function setDatabase($database){
        $this->database = $database;
    }

    public function setConnection($connection){
        $this->connection = $connection;
    }

    public function getDatabase(){
        return $this->database;
    }

    public function getConnection(){
        return $this->connection;
    }



    public function databaseConnectionEstablished(){
        try{
            if(empty($this->database) || is_null($this->database)){
                $this->database = Database::getInstance();
            }
            if(empty($this->connection) || is_null($this->connection)){
                $this->connection = $this->database->getConnection();
            }

            return true;
        } catch (\Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }
}