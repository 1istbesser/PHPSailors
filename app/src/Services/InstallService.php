<?php
namespace PHPSailors\Services;
use PHPSailors\Core\Service;
use PHPSailors\Core\Database;
use PDO;

class InstallService extends Service{
    private $database;
    private $connection;

    const ACTIVE = "active";
    const INACTIVE = "inactive";

    public function __construct(){   
        $this->database = Database::getInstance();
        $this->connection = $this->database->getConnection();
    }

    public function createTables(){
        $query= "CREATE TABLE IF NOT EXISTS `user`(
            id_user int NOT NULL UNIQUE AUTO_INCREMENT,
            email varchar(100) UNIQUE,
            password varchar(255),
            id_role int,
            auth_token varchar(255),
            status varchar(50),
            last_modified_at datetime,
            created_at datetime,
            PRIMARY KEY (id_user)
        )";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([]);

        $query= "CREATE TABLE IF NOT EXISTS `role`(
            id_role int NOT NULL UNIQUE AUTO_INCREMENT,
            role varchar(100),
            PRIMARY KEY (id_role)
        )";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([]);

        $query= "CREATE TABLE IF NOT EXISTS `authentication_log`(
            id_authentication_log int NOT NULL UNIQUE AUTO_INCREMENT,
            id_user int,
            login_datetime datetime,
            PRIMARY KEY (id_authentication_log)
        )";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([]);
        
    }

    public function createUserRoles(){
        $query= "SELECT COUNT(id_role) FROM `role` WHERE role =? OR role =?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(["user", "admin"]);
        $rolesCounter = $stmt->fetchColumn();

        if(0 === (int)$rolesCounter ){
            $query= "INSERT INTO `role`(role) VALUES(?)";
            $stmt = $this->connection->prepare($query);
            $stmt->execute(["user"]);
    
            $query= "INSERT INTO `role`(role) VALUES(?)";
            $stmt = $this->connection->prepare($query);
            $stmt->execute(["admin"]);
        }

    }

    public function registerAdmin(){
        $query= "SELECT COUNT(id_user) FROM `user` WHERE email = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(["admin@phpsailors.com"]);
        $adminCounter = $stmt->fetchColumn();

        if(0 === (int)$adminCounter){
            $dateTimeNow = date("Y-m-d H:m:i");
            $email = "admin@phpsailors.com";
            $random_password = $this->random_code(10);
            $random_password_encrypted = password_hash($random_password, PASSWORD_DEFAULT);
            $account_role = 2;
            $query = "INSERT INTO `user`(email, password, id_role, status, last_modified_at, created_at) VALUES(?,?,?,?,?,?);";
            $stmt = $this->connection->prepare($query);
            $stmt->execute([ $email, $random_password_encrypted, $account_role, InstallService::ACTIVE, $dateTimeNow, $dateTimeNow ]);
            return (Object)[
                "email" => $email,
                "password" => $random_password
            ];
        } else {
            return 409;
        }

    }

    function random_code($limit){
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

}