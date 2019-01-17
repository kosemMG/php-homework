<?php

namespace app\models;

use app\interfaces\IRecord;
use app\services\Db;

/**
 * Class Record - an abstract class, a parent. Contains methods creating objects and changing a database.
 * @package app\models
 */
abstract class Record implements IRecord
{
    protected $db;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = static::getDb();
    }

    /**
     * @return Db
     */
    private static function getDb()
    {
        return Db::getInstance();
    }

    /**
     * @param int $id
     * @return object
     */
    public static function getOne(int $id)
    {
        $table_name = static::getTableName();
        $sql = "SELECT * FROM `{$table_name}` WHERE id = :id";
        return static::getDb()->queryObject($sql, get_called_class(), [':id' => $id]);
    }

    /**
     * @return static[]
     */
    public static function getAll()
    {
        $table_name = static::getTableName();
        $sql = "SELECT * FROM `{$table_name}`";
        return static::getDb()->queryAllObjects($sql, get_called_class());
    }

    /**
     * Deletes a row from a database.
     * @return bool
     */
    public function delete()
    {
        $table_name = static::getTableName();
        $sql = "DELETE FROM `{$table_name}` WHERE id = :id";
        return $this->db->execute($sql, [':id' => $this->id]);
    }

    /**
     * Saves changes in a database.
     */
    public function commitChange()
    {
        if ($this->id === '') {
            $this->insert();
        } else {
            $this->update();
        }
    }

    /**
     * Inserts a row to a database.
     */
    private function insert()
    {
        $columns = [];
        $params = [];

        foreach ($this->properties as $key => $value) {
            if ($value === '') {
                $value = null;
            }

            $params[":{$key}"] = $value;
            $columns[] = "`{$key}`";
        }

        $columns = implode(", ", $columns);
        $placeholders = implode(", ", array_keys($params));

        $table_name = static::getTableName();
        $sql = "INSERT INTO `{$table_name}` ({$columns}) VALUES ({$placeholders})";

        $this->db->execute($sql, $params);

        $this->id = $this->db->lastInsertId();
    }

    /**
     * Updates row values in a database.
     */
    private function update()
    {
        $set_string = '';
        $params = [];
        $new_properties = [];

        foreach ($this->properties as $key => $value) {
            if ($this->properties[$key] !== $this->old_properties[$key]) {
                $new_properties[$key] = $value;
                $params[":{$key}"] = $value;
            }
        }

        $params[':id'] = $this->id;

        foreach ($new_properties as $key => $value) {
            if ($new_properties[$key] === end($new_properties)) {
                $set_string .= "`{$key}` = :{$key} ";
            } else {
                $set_string .= "`{$key}` = :{$key}, ";
            }
        }

        $table_name = static::getTableName();
        $sql = "UPDATE `{$table_name}` SET {$set_string} WHERE id = :id";

        $this->db->execute($sql, $params);
    }
}