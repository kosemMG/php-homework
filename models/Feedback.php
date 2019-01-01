<?php

namespace app\models;


class Feedback extends Model
{
    public $id;
    public $user_id;
    public $message;

    public function getTableName(): string
    {
        return 'feedbacks';
    }
}