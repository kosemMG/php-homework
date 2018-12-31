<?php

namespace app\interfaces;


interface IModel
{
    function get_one(int $id);

    function get_all();

    function get_table_name() : string;
}