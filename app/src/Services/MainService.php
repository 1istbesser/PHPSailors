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
        try {
            $this->database = Database::getInstance();
            $this->connection = $this->database->getConnection();
        } catch (\Exception $e) {
            throw new \Exception('Database is offline.');
        }
    }

    public function getAllProducts()
    {
        $query = "Select * from `produse`";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([]);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}