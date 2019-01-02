<?php

namespace app\services;

use app\interfaces\IDb;
use app\traits\TSingleton;

class Db implements IDb
{
    use TSingleton;

    private $config = [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'login' => 'root',
        'password' => 'password',
        'database' => 'comp_shop',
        'charset' => 'utf8'
    ];

    private $conn = null;

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

    private function prepareDsnString()
    {
        return sprintf('%s:host=%s;dbname=%s;charset=%s',
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }

    private function query($sql, $params = [])
    {
        $pdo_statement = $this->getConnection()->prepare($sql);
        $pdo_statement->execute($params);

        return $pdo_statement;
    }

    public function queryOne(string $sql, array $params = [])
    {
        return $this->queryAll($sql, $params)[0];
    }

    public function queryAll(string $sql, array $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function execute($sql, $params = [])
    {
        $this->query($sql, $params);
        return true;
    }
}