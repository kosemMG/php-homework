<?php

namespace app\services;

use app\interfaces\IDb;
use app\traits\TSingleton;

/**
 * Class Db contains methods managing a database.
 * @package app\services
 */
class Db implements IDb
{
    use TSingleton;

    private $config = [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'login' => 'root',
        'password' => 'password',
        'database' => 'brand_shop',
        'charset' => 'utf8'
    ];

    private $conn = null;

    /**
     * Creates connection via PDO.
     * @return \PDO|null
     */
    private function getConnection()
    {
        if (is_null($this->conn)) {
            $this->conn = new \PDO(
                $this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']
            );

            $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }

        return $this->conn;
    }

    /**
     * Prepares DSN string.
     * @return string
     */
    private function prepareDsnString()
    {
        return sprintf('%s:host=%s;dbname=%s;charset=%s',
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }

    /**
     * Creates PDOStatement and executes SQL query.
     * @param $sql
     * @param array $params
     * @return bool|\PDOStatement
     */
    private function query($sql, $params = [])
    {
        $pdo_statement = $this->getConnection()->prepare($sql);
        $pdo_statement->execute($params);

        return $pdo_statement;
    }

    /**
     * Returns an array.
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function queryOne(string $sql, array $params = [])
    {
        return $this->queryAll($sql, $params)[0];
    }

    /**
     * Returnds an array of arrays.
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function queryAll(string $sql, array $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    /**
     * Returns an object.
     * @param $sql
     * @param $class
     * @param array $params
     * @return object
     */
    public function queryObject($sql, $class, $params = []) {
        $pdo_statement = $this->query($sql, $params);
        $pdo_statement->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);

        return $pdo_statement->fetch();
    }

    /**
     * Returns an array of objects.
     * @param $sql
     * @param $class
     * @param array $params
     * @return array
     */
    public function queryAllObjects($sql, $class, $params = []) {
        $pdo_statement = $this->query($sql, $params);
        $pdo_statement->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);

        return $pdo_statement->fetchAll();
    }

    /**
     * Executes an SQL query.
     * @param $sql
     * @param array $params
     * @return bool
     */
    public function execute($sql, $params = [])
    {
        $this->query($sql, $params);
        return true;
    }

    public function lastInsertId()
    {
        return $this->getConnection()->lastInsertId();
    }
}