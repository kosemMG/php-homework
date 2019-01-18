<?php

namespace app\models;

use app\models\entities\DataEntity;
use app\services\Db;

/**
 * Class Cart includes all cart methods and properties.
 * @package app\models
 */
class Cart extends DataEntity
{
    public $properties = [
        'id' => '',
        'product_id' => '',
        'amount' => ''
    ];

    public $old_properties = [
        'id' => '',
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
     * @param string $name
     * @return mixed
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