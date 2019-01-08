<?php

namespace app\models;

/**
 * Class Vendor
 * @package app\models
 */
class Vendor extends DbModel
{
    public $properties = [
        'id' => '',
        'name' => ''
    ];

    public $old_properties = [
        'id' => '',
        'name' => ''
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
     * Returns 'vendors' the name of vendors table.
     * @return string
     */
    public static function getTableName(): string
    {
        return 'vendors';
    }
}