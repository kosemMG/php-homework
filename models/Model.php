<?php

namespace app\models;

use app\interfaces\IModel;
use app\services\Db;

abstract class Model implements IModel
{
    protected $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function get_one(int $id)
    {
        $sql = "SELECT * FROM {$this->get_table_name()} WHERE id = {$id}";
        return $this->db->query_one($sql);
    }

    public function get_all()
    {
        $sql = "SELECT * FROM {$this->get_table_name()}";
        return $this->db->query_all($sql);
    }
}