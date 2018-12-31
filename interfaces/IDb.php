<?php

namespace app\interfaces;


interface IDb
{
    function query_one(string $sql, array $params = []);

    function query_all(string $sql, array $params = []);
}