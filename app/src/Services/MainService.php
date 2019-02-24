<?php
namespace PHPSailors\Services;
use PHPSailors\Core\Service;
use PHPSailors\Core\Database;
use PDO;

class MainService extends Service{
    private $database;
    private $connection;

    public function __construct()
    {
        $this->database = Database::getInstance();
        $this->connection = $this->database->getConnection();
    }

    public function getAllProducts()
    {
        /* Example of query */
        $query = "Select * from `product` limit 25";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([]);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}