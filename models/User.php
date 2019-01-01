<?php

namespace app\models;


class User extends Model
{
    public $id;
    public $login;
    public $password;
    public $name;
    public $email;

    public function get_table_name() : string
    {
        return 'users';
    }
}