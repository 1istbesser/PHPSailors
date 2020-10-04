<?php

declare(strict_types=1);

namespace App\Core;

class Model
{
    public $connection;

    public function __construct()
    {
        $this->connection = new DatabaseConnection();
        $this->connection->databaseConnectionEstablished();
    }
}
