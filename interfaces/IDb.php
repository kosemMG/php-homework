<?php

namespace app\interfaces;


interface IDb
{
    function queryOne(string $sql, array $params = []);

    function queryAll(string $sql, array $params = []);
}