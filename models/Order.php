<?php

namespace app\models;


class Order extends Model
{
    public $id;
    public $user_id;
    public $cart_id;

    public static function getTableName() : string
    {
        return 'orders';
    }
}