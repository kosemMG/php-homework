<?php

namespace app\models;

/**
 * Class Cart
 * @package app\models
 */
class Cart extends DbModel
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

    /**
     * Cart constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->old_properties = $this->properties;
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if (isset($this->properties[$name])) {
            $this->properties[$name] = $value;
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
     * Returns 'carts' the name of carts table.
     * @return string
     */
    public static function getTableName(): string
    {
        return 'carts';
    }
}