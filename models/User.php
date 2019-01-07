<?php

namespace app\models;

/**
 * Class User
 * @package app\models
 */
class User extends Model
{
    public $properties = [
        'id' => '',
        'login' => '',
        'password' => '',
        'name' => '',
        'email' => ''
    ];

    public $old_properties = [
        'id' => '',
        'login' => '',
        'password' => '',
        'name' => '',
        'email' => ''
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
     * Returns 'users' the name of users table.
     * @return string
     */
    public static function getTableName() : string
    {
        return 'users';
    }
}