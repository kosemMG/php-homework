<?php

namespace app\models;

/**
 * Class Order
 * @package app\models
 */
class Order extends Model
{
    public $properties = [
        'id' => '',
        'user_id' => '',
        'message' => ''
    ];

    public $old_properties = [
        'id' => '',
        'user_id' => '',
        'cart_id' => ''
    ];

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if (isset($this->properties[$name])) {
            $this->properties[$name] = $value;
            $this->old_properties[$name] = $value;
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (isset($this->properties[$name])) {
            return $this->properties[$name];
        }
    }

    /**
     * Returns 'orders' the name of orders table.
     * @return string
     */
    public static function getTableName() : string
    {
        return 'orders';
    }
}