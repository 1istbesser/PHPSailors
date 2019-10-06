<?php
use PHPSailors\Config\DatabaseConfig;

require_once("../../src/Config/DatabaseConfig.php");

const ACTIVE = "active";
const INACTIVE = "inactive";

function createTables($connection){
  try{
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
    $stmt = $connection->prepare($query);
    $stmt->execute([]);

    $query= "CREATE TABLE IF NOT EXISTS `role`(
        id_role int NOT NULL UNIQUE AUTO_INCREMENT,
        role varchar(100),
        PRIMARY KEY (id_role)
    )";
    $stmt = $connection->prepare($query);
    $stmt->execute([]);

    $query= "CREATE TABLE IF NOT EXISTS `authentication_log`(
        id_authentication_log int NOT NULL UNIQUE AUTO_INCREMENT,
        id_user int,
        login_datetime datetime,
        PRIMARY KEY (id_authentication_log)
    )";
    $stmt = $connection->prepare($query);
    $stmt->execute([]);
    } catch(Exception $e){
      error_log($e);
      http_response_code(500);
      exit;
    }
}

function createUserRoles($connection){
    $query= "SELECT COUNT(id_role) FROM `role` WHERE role =? OR role =?";
    $stmt = $connection->prepare($query);
    $stmt->execute(["user", "admin"]);
    $rolesCounter = $stmt->fetchColumn();

    if(0 === (int)$rolesCounter ){
        $query= "INSERT INTO `role`(role) VALUES(?)";
        $stmt = $connection->prepare($query);
        $stmt->execute(["user"]);

        $query= "INSERT INTO `role`(role) VALUES(?)";
        $stmt = $connection->prepare($query);
        $stmt->execute(["admin"]);
    }

}

function registerAdmin($connection){
    $query= "SELECT COUNT(id_user) FROM `user` WHERE email = ?";
    $stmt = $connection->prepare($query);
    $stmt->execute(["admin@phpsailors.com"]);
    $adminCounter = $stmt->fetchColumn();

    if(0 === (int)$adminCounter){
        $dateTimeNow = date("Y-m-d H:m:i");
        $email = "admin@phpsailors.com";
        $random_password = random_code(10);
        $random_password_encrypted = password_hash($random_password, PASSWORD_DEFAULT);
        $account_role = 2;
        $query = "INSERT INTO `user`(email, password, id_role, status, last_modified_at, created_at) VALUES(?,?,?,?,?,?);";
        $stmt = $connection->prepare($query);
        $stmt->execute([ $email, $random_password_encrypted, $account_role, ACTIVE, $dateTimeNow, $dateTimeNow ]);
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

function installApp($connection){
  createTables($connection);
  createUserRoles($connection);
  $account = registerAdmin($connection);
  if(!is_object($account) && 409 === (int)$account){
      echo "The installation has already been done.";
      exit;
  } else {
      echo "The tables, user roles and an admin account have been created for you.";
      echo "<br/>";
      echo "Email: " . $account->email;
      echo "<br/>";
      echo "Password: " . $account->password;
      exit;
  }
}


try {

  $databaseConfig = new DatabaseConfig();

  $host = $databaseConfig->getHost();
  $db   = $databaseConfig->getDB();
  $user = $databaseConfig->getUser();
  $pass = $databaseConfig->getPassword();
  $charset = 'utf8mb4';

  $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
  $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
  ];

  $connection = new PDO($dsn, $user, $pass, $options);
  installApp($connection);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
