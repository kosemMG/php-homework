<?php

namespace app\models;


class Feedback extends Model
{
    public $id;
    public $user_id;
    public $message;

    public static function getTableName(): string
    {
        return 'feedbacks';
    }
}