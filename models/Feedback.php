<?php

namespace app\models;

/**
 * Class Feedback
 * @package app\models
 */
class Feedback extends DbModel
{
    public $properties = [
        'id' => '',
        'user_id' => '',
        'message' => ''
    ];

    public $old_properties = [
        'id' => '',
        'user_id' => '',
        'message' => ''
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
     * Returns 'feedbacks' the name of feedbacks table.
     * @return string
     */
    public static function getTableName(): string
    {
        return 'feedbacks';
    }
}