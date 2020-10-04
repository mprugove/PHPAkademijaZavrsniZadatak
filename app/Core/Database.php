<?php


namespace App\Core;

class Database extends \PDO
{
    private static $instance;

    private function __construct()
    {
        $dbConfig = Config::get('db');
        $dsn = 'mysql:host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['name'] . ';charset=utf8';
        parent::__construct($dsn, $dbConfig['user'], $dbConfig['password']);
        $this->setAttribute(
            \PDO::ATTR_DEFAULT_FETCH_MODE,
            \PDO::FETCH_ASSOC
        );
    }

    public static function getInstance(): self
    {
        if (static::$instance === null) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}