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
}