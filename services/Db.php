<?php

namespace app\services;

use app\interfaces\IDb;

class Db implements IDb
{
    public function query_one(string $sql, array $params = [])
    {
        return [];
    }

    public function query_all(string $sql, array $params = [])
    {
        return [];
    }
}