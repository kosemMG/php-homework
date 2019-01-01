<?php

namespace app\models;


class Order extends Model
{
    public $id;
    public $user_id;
    public $cart_id;

    public function get_table_name() : string
    {
        return 'orders';
    }
}