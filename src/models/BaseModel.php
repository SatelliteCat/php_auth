<?php

namespace src\models;

abstract class BaseModel
{
    const DB_HOST = 'db';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = 'example';
    const DB_NAME = 'php_auth';

    private $pdo;

    public function __construct()
    {
        $dsn = "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME;
        $this->pdo = new \PDO
        (
            $dsn,
            self::DB_USERNAME,
            self::DB_PASSWORD
        );
    }

    /**
     * @return \PDO
     */
    public function getPdo()
    {
        return $this->pdo;
    }
}