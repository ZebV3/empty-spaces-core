<?php

namespace zebv3\EmptySpacesCore\db;

use zebv3\EmptySpacesCore\Application;
use zebv3\EmptySpacesCore\Model;

/**
 * Class DbModel
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package zebv3\EmptySpacesCore
 */

abstract class DbModel extends Model
{
    abstract public static function table_name(): string;
    abstract public function attributes(): array;
    public static function primary_key(): string
    {
        return 'id';
    }

    public static function prepare($sql)
    {
        return Application::$application->db->pdo->prepare($sql);
    }

    public function save()
    {
        $table_name = $this->table_name();
        $attributes = $this->attributes();
        $params = array_map(fn($att) => ":$att", $attributes);
        $statement = self::prepare("INSERT INTO $table_name (" . implode(',', $attributes) . ") 
        VALUES (" . implode(',', $params) . ")");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }

    public static function find_one($where)
    {
        $table_name = static::table_name();
        $attributes = array_keys($where);

        $sql = implode("AND ", array_map(fn($att) => "$att = :$att", $attributes));
        $statement = self::prepare("SELECT * FROM $table_name WHERE $sql");

        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();
        return @$statement->fetchObject(static::class);
    }
}