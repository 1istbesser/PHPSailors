<?php
namespace PHPSailors\Core;
use PDO;
use phpDocumentor\Reflection\Types\Integer;
use PHPSailors\Config\DatabaseConfig;

class Database
{
    private $host = NULL;
    private $db = NULL;
    private $user = NULL;
    private $pass = NULL;
    private $charset = 'utf8mb4';
    private $dsn = NULL;
    private $opt = NULL;
    private $connection = NULL;
    private static $database = NULL;
    private $config = NULL;

    private function __construct()
    {
        /**
         * Set all config params from src\Config
         */
        $this->config = new DatabaseConfig();
        $this->host = $this->config->getHost();
        $this->db = $this->config->getDB();
        $this->user = $this->config->getUser();
        $this->pass = $this->config->getPassword();
        $this->setConfig();
    }

    private function setConfig():void {
        $this->dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $this->opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->connection = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
    }

    /**
     * @return Core\Database
     * Only one instance allowed.
     */
    static function getInstance():Database {
        if (NULL == self::$database) {
            self::$database = new Database();
        }
        return self::$database;
    }

    /**
     * @return PDO connection
     */
    public function getConnection(): PDO {
        return $this->connection;
    }
}