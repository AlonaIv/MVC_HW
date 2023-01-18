<?php

namespace Core\Traits;

use Core\Db;
use PDO;


trait Queriable
{
    static protected string|null $tableName = '';
    static protected string $query = '';
    protected array $commands = [];

    public static function select(array $columns = ['*']): static
    {
        static::resetQuery();
        static::$query = "SELECT " . implode(',', $columns) . " FROM " . static::$tableName . " ";

        $obj = new static();
        $obj->commands[] = 'select';

        return $obj;
    }

    public static function create(array $data): int
    {
        $params = static::prepareQueryVars($data);
        $query = "INSERT INTO " . static::$tableName . " ({$params['keys']}) VALUES ({$params['placeholders']})";
        $query = Db::connect()->prepare($query);

        $query->execute($data);

        return (int)Db::connect()->lastInsertId();
    }

    public static function all(): array
    {
        static::resetQuery();
        static::$query = 'SELECT * FROM ' . static::$tableName;

        $obj = new static();
        $obj->commands[] = 'all';

        return $obj->get();
    }

    protected static function prepareQueryVars(array $fields): array
    {
        $keys = array_keys($fields);
        $placeholders = preg_filter('/^/', ':', $keys);

        return [
            'keys' => implode(', ', $keys),
            'placeholders' => implode(', ', $placeholders)
        ];
    }

    protected static function resetQuery()
    {
        static::$query = '';
    }

    public function get()
    {
        return Db::connect()->query(static::$query)->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public function where(string $column, string $operator, $value): static
    {
        if (!$this->can(['select'])) {
            throw new \Exception('[select] command should be called before where');
        }

        static::$query .= "WHERE {$column} {$operator} {$value}";
        $obj = new static();
        $obj->commands[] = 'where';

        return $obj;
    }

    protected function can(array $allowedMethods)
    {
        foreach ($allowedMethods as $method) {
            if (in_array($method, $this->commands)) {
                return true;
            }
        }
        return false;
    }

    static function findBy(string $column, $value)
    {
        $query = "SELECT * FROM " . static::$tableName . " WHERE {$column}=:{$column}";

        $query = Db::connect()->prepare($query);
        $query->bindParam($column, $value);
        $query->execute();

        return $query->fetchObject(static::class);
    }
}