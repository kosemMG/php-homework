<?php

namespace app\models\entities;

/**
 * Class Order contains orders methods and properties.
 * @package app\models\entities
 */
class Order extends Entity
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
     * Order constructor.
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
     * Returns 'orders' the name of an orders table.
     * @return string
     */
    public static function getTableName() : string
    {
        return 'orders';
    }
}