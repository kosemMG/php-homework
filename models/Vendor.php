<?php

namespace app\models;


class Vendor extends Model
{
    public $id;
    public $name;

    public function get_table_name(): string
    {
        return 'vendors';
    }
}