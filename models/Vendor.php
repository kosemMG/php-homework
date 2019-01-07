<?php

namespace app\models;


class Vendor extends Model
{
    public $id;
    public $name;

    public static function getTableName(): string
    {
        return 'vendors';
    }
}