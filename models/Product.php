<?php

namespace app\models;

class Product extends  Model
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $vendor_id;

    public function get_table_name() : string
    {
        return 'products';
    }
}