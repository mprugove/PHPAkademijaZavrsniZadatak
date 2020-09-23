<?php

namespace App\Model;

use App\Core\Database;
use App\Core\DataObject;

abstract class AModel extends DataObject
{

    protected static $table;
    protected static function getTable(): string
    {
        if (static::$table) {
            return static::$table;
        }

        throw new \Exception('$table property is not set.');
    }

    protected static function createObject(array $data): self
    {
        return new static($data);
    }

    public static function getOne(string $column, $value): self
    {
        $table = static::getTable();
        $sql = "SELECT * FROM {$table} WHERE {$column} = :value";

        $statement = Database::getInstance()->prepare($sql);
        $statement->bindValue('value', $value);
        $statement->execute();

        $firstRow = $statement->fetch() ?: [];
        return static::createObject($firstRow);
    }

    public static function getMultiple(string $column, $value, string $orderBy = null, array $limit = []): array
    {
        $table = static::getTable();
        $sql = "SELECT * FROM {$table} WHERE {$column} = :value";


        $statement = Database::getInstance()->prepare($sql);
        $statement->bindValue('value', $value);
        $statement->execute();

        $models = [];
        while ($row = $statement->fetch()) {
            $models[] = static::createObject($row);
        }

        return $models;
    }

    public static function getAll(string $orderBy = null, array $limit = []): array
    {
        $table = static::getTable();
        $sql = "SELECT * FROM {$table}";

        if ($orderBy) {
            $sql .= " ORDER BY {$orderBy}";
        }

        if ($limit) {
            $sql .= " LIMIT {$limit[0]}, {$limit[1]}";
        }

        $statement = Database::getInstance()->prepare($sql);
        $statement->execute();

        $models = [];
        while ($row = $statement->fetch()) {
            $models[] = static::createObject($row);
        }

        return $models;
    }

    public static function insert($data)
    {
        $table = static::getTable();

        $columns = [];
        $values = [];
        foreach (array_keys($data) as $column) {
            $columns[] = $column;
            $values[] = ":{$column}";
        }

        $columnsString = implode(', ', $columns);
        $valuesString = implode(', ', $values);

        $sql = "INSERT INTO {$table} ($columnsString) VALUES ($valuesString)";

        $statement = Database::getInstance()->prepare($sql);
        $statement->execute($data);
    }

    public static function delete(string $column, $value)
    {
        $table = static::getTable();
        $sql = "DELETE FROM {$table} WHERE {$column} = :value";

        $statement = Database::getInstance()->prepare($sql);
        $statement->bindValue('value', $value);
        $statement->execute();
    }
}