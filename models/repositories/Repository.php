<?php

namespace app\models\repositories;

use app\base\App;
use app\interfaces\IRepository;
use app\models\entities\Entity;

/**
 * Class Repository contains methods for reading from and writing into a database.
 * @package app\models\repositories
 */
abstract class Repository implements IRepository
{
    protected $db;

    /**
     * Repository constructor.
     */
    public function __construct()
    {
        $this->db = App::call()->db;
    }

    /**
     * Creates an object from a database record by assigned column.
     * @param int $value
     * @param string $column
     * @return object
     */
    public function getOne(int $value, string $column = 'id')
    {
        $table_name = $this->getTableName();
        $sql = "SELECT * FROM `{$table_name}` WHERE {$column} = :{$column}";
        return $this->db->queryObject($sql, $this->getEntityClass(), [":{$column}" => $value]);
    }

    /**
     * Creates an array of objects of all table database records.
     * @return array
     */
    public function getAll()
    {
        $table_name = $this->getTableName();
        $sql = "SELECT * FROM `{$table_name}`";
        return $this->db->queryAllObjects($sql, $this->getEntityClass());
    }

    /**
     * Deletes a row from a database.
     * @param Entity $entity
     * @return bool
     */
    public function delete(Entity $entity)
    {
        $table_name = $this->getTableName();
        $sql = "DELETE FROM `{$table_name}` WHERE id = :id";
        return $this->db->execute($sql, [':id' => $entity->id]);
    }

    /**
     * Clears a table.
     * @return bool
     */
    public function clear()
    {
        $table_name = $this->getTableName();
        $sql = "TRUNCATE TABLE `{$table_name}`";
        return $this->db->execute($sql);
    }

    /**
     * Saves changes in a database.
     * @param Entity $entity
     */
    public function commitChange(Entity $entity)
    {
        if ($entity->id === '') {
            $this->insert($entity);
            echo 'insert';exit;
        } else {
            echo 'update';exit;
            $this->update($entity);
        }
    }

    /**
     * Inserts a record to a database.
     * @param Entity $entity
     */
    protected function insert(Entity $entity)
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
     * Updates a record in a database.
     * @param Entity $entity
     */
    protected function update(Entity $entity)
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

        $params[':id'] = $entity->id;

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