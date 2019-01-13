<?php

namespace app\interfaces;

/**
 * Interface IRecord
 * @package app\interfaces
 */
interface IRecord
{
    public static function getOne(int $id);

    public static function getAll();

    public static function getTableName() : string;
}