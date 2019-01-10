<?php

namespace app\models;

/**
 * Class Product
 * @package app\models
 */
class Product extends DbModel
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
     * Returns 'products' the name of products table.
     * @return string
     */
    public static function getTableName(): string
    {
        return 'products';
    }
}