<?php

namespace app\models\repositories;

use app\models\entities\DataEntity;
use app\services\Db;

abstract class Repository
{
    protected $db;

    /**
     * Repository constructor.
     */
    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    /**
     * Creates an object from a database record.
     * @param int $id
     * @return object
     */
    public function getOne(int $id)
    {
        $table_name = $this->getTableName();
        $sql = "SELECT * FROM `{$table_name}` WHERE id = :id";
        return $this->db->queryObject($sql, $this->getEntityClass(), [':id' => $id]);
    }

    /**
     * Creates an array of objects of all table database records.
     * @return array
     */
    public function getAll()
    {
        $table_name = $this->getTableName();
        $sql = "SELECT * FROM `{$table_name}`";
        return $this->db->queryAllObjects($sql, get_called_class());
    }

    /**
     * Deletes a row from a database.
     * @return bool
     */
    public function delete(DataEntity $entity)
    {
        $table_name = $this->getTableName();
        $sql = "DELETE FROM `{$table_name}` WHERE id = :id";
        return $this->db->execute($sql, [':id' => $entity->id]);
    }

    /**
     * Saves changes in a database.
     */
    public function commitChange(DataEntity $entity)
    {
        if ($entity->id === '') {
            $this->insert($entity);
        } else {
            $this->update($entity);
        }
    }

    /**
     * Inserts a row to a database.
     */
    private function insert(DataEntity $entity)
    {
        $columns = [];
        $params = [];

        foreach ($entity->properties as $key => $value) {
            if ($value === '') {
                $value = null;
            }

            $params[":{$key}"] = $value;
            $columns[] = "`{$key}`";
        }

        $columns = implode(", ", $columns);
        $placeholders = implode(", ", array_keys($params));

        $table_name = $this->getTableName();
        $sql = "INSERT INTO `{$table_name}` ({$columns}) VALUES ({$placeholders})";

        $this->db->execute($sql, $params);

        $entity->id = $this->db->lastInsertId();
    }

    /**
     * Updates row values in a database.
     */
    private function update(DataEntity $entity)
    {
        $set_string = '';
        $params = [];
        $new_properties = [];

        foreach ($entity->properties as $key => $value) {
            if ($entity->properties[$key] !== $entity->old_properties[$key]) {
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

        $table_name = $this->getTableName();
        $sql = "UPDATE `{$table_name}` SET {$set_string} WHERE id = :id";

        $this->db->execute($sql, $params);
    }

    /**
     * Returns a table name.
     * @return string
     */
    abstract public function getTableName(): string;

    /**
     * Returns an inheritor class.
     * @return string
     */
    abstract public function getEntityClass(): string;
}