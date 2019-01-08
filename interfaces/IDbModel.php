<?php

namespace app\interfaces;

/**
 * Interface IDbModel
 * @package app\interfaces
 */
interface IDbModel
{
    public static function getOne(int $id);

    public static function getAll();

    public static function getTableName() : string;
}