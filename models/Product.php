<?php

namespace app\models;

class Product extends Model
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

    public function __set($name, $value)
    {
        if (isset($this->properties[$name])) {
            $this->properties[$name] = $value;
            $this->old_properties[$name] = $value;
        }
    }

    public function __get($name)
    {
        if (isset($this->properties[$name])) {
            return $this->properties[$name];
        }
    }

    public static function getTableName(): string
    {
        return 'products';
    }
}