<?php

namespace app\models\entities;


/**
 * Class Cart contains cart methods and properties.
 * @package app\models\entities
 */
class Cart extends Entity
{
    public $properties = [
        'id' => '',
        'user_id' => '',
        'product_id' => '',
        'amount' => ''
    ];

    public $old_properties = [
        'id' => '',
        'user_id' => '',
        'product_id' => '',
        'amount' => ''
    ];

    /**
     * Cart constructor.
     */
    public function __construct()
    {
        $this->old_properties = $this->properties;
    }

    /**
     * @param string $name
     * @param string|int|float $value
     */
    public function __set($name, $value)
    {
        if (isset($this->properties[$name])) {
            $this->properties[$name] = $value;
        }
    }

    /**
     * @param $name
     * @return bool|mixed
     */
    public function __get($name)
    {
        if (isset($this->properties[$name])) {
            return $this->properties[$name];
        } else {
            return false;
        }
    }
}