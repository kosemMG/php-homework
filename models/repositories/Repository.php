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
     * @param mixed $value
     * @param string $column
     * @return object
     */
    public function getOne($value, string $column = 'id')
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
     * Creates an object from a database record by several columns.
     * @param array $params
     * @return object
     */
    public function getOneByMany(array $params)
    {
        $placeholders = [];
        $modified_params = [];

        foreach ($params as $key => $value) {
            $placeholders[$key] = "{$key} = :{$key}";
            $key = ':' . $key;
            $modified_params[$key] = $value;
        }

        $table_name = $this->getTableName();
        $sql = "SELECT * FROM `{$table_name}` WHERE " . implode(' AND ', $placeholders);

        return $this->db->queryObject($sql, $this->getEntityClass(), $modified_params);
    }

    /**
     * Searches a database table for specific values.
     * @param array $params
     * @return bool
     */
    public function search(array $params){
        $entities = $this->getAll();

        foreach ($entities as $entity) {
            foreach ($params as $key => $value) {
                if ($entity->properties[$key] === $params[$key]) {
                    return true;
                }
            }
        }

        return false;
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
        } else {
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
        $set_array = [];
        $params = [];
        $new_properties = [];


        foreach ($entity->properties as $key => $value) {
            if ($entity->properties[$key] !== $entity->old_properties[$key]) {
                $new_properties[$key] = $value;
                $params[":{$key}"] = $value;
            }
        }

        $i = 0;
        foreach ($new_properties as $key => $value) {
            $set_array[$i] = "`{$key}` = :{$key}";
            $i++;
        }

        $set_string = implode(', ', $set_array);

        $params[':id'] = $entity->id;

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