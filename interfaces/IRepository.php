<?php

namespace app\interfaces;

/**
 * Interface IRepository
 * @package app\interfaces
 */
interface IRepository
{
    public function getOne(int $id, string $column = 'id');

    public function getAll();

    public function getTableName() : string;
}