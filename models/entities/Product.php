<?php

namespace app\models\entities;

/**
 * Class Product contains products methods and properties.
 * @package app\models
 */
class Product extends Entity
{
    public $properties = [
        'id' => '',
        'name' => '',
        'description' => '',
        'price' => '',
        'vendor_id' => '',
        'image_path' => ''
    ];

    public $old_properties = [
        'id' => '',
        'name' => '',
        'description' => '',
        'price' => '',
        'vendor_id' => '',
        'image_path' => ''
    ];

    /**
     * Product constructor.
     */
    public function __construct()
    {
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