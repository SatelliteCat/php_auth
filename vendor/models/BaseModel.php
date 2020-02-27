<?php

namespace vendor\models;

abstract class BaseModel
{
    const DB_HOST = 'db';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = 'example';
    const DB_NAME = 'php_auth';

    private $mysqli;

    public function __construct()
    {
        $this->mysqli = new \mysqli
        (
            self::DB_HOST,
            self::DB_USERNAME,
            self::DB_PASSWORD,
            self::DB_NAME
        );
    }

    /**
     * @return \mysqli
     */
    public function getMysqli()
    {
        return $this->mysqli;
    }
}