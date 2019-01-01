<?php

namespace app\models;


class Feedback extends Model
{
    public $id;
    public $user_id;
    public $message;

    public function get_table_name(): string
    {
        return 'feedbacks';
    }
}