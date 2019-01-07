<?php

namespace app\models;


class Cart extends Model
{
    public $properties = [
        'id' => '',
        'user_id' => '',
        'product_id' => '',
        'amount' => '',
        'status' => '',
    ];

    public $old_properties = [
        'id' => '',
        'user_id' => '',
        'product_id' => '',
        'amount' => '',
        'status' => '',
    ];

    public static function getTableName(): string
    {
        return 'carts';
    }
}