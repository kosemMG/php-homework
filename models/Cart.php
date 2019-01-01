<?php

namespace app\models;


class Cart extends Model
{
    public $id;
    public $user_id;
    public $product_id;
    public $amount;
    public $status;

    public function getTableName(): string
    {
        return 'carts';
    }
}