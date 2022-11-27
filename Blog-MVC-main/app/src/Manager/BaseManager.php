<?php

namespace App\Manager;

use App\Interfaces\Database;

abstract class BaseManager
{
    protected \PDO $pdo;

    public function __construct(Database $database)
    {
        return $this->pdo = $database->getMySqlPDO();
    }
}