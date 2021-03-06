<?php

namespace app\interfaces;

/**
 * Interface IModel
 * @package app\interfaces
 */
interface IModel
{
    public static function getOne(int $id);

    public static function getAll();

    public static function getTableName() : string;
}