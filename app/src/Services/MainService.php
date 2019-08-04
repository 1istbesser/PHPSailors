<?php
namespace PHPSailors\Services;
use PHPSailors\Core\Service;
use PHPSailors\Core\Database;
use PDO;

class MainService extends Service{
    private $database;
    private $connection;
    private $dateTimeNow = "";
    const ACTIVE = "active";
    const INACTIVE = "inactive";

    public function __construct(){   
        $this->dateTimeNow = date("Y-m-d H:m:i");
        $this->database = Database::getInstance();
        $this->connection = $this->database->getConnection();
    }

    public function createTables(){
        $query= "CREATE TABLE `user`(
            id_user int NOT NULL UNIQUE AUTO_INCREMENT,
            email varchar(100),
            password varchar(255),
            status varchar(50),
            last_modified_at datetime,
            created_at datetime,
            PRIMARY KEY (id_user)
        )";
        $stmt = $this->connection->prepare($query);
        $result = $stmt->execute([]);
        
    }

    public function registerUser($email, $password){

        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO `user`(email, password, status, last_modified_at, created_at) VALUES(?,?,?,?,?);";
        $stmt = $this->connection->prepare($query);
        $result = $stmt->execute([ $email, $password, MainService::ACTIVE, $this->dateTimeNow, $this->dateTimeNow ]);
        return $result;

    }
}