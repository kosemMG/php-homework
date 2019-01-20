<?php

namespace app\models\repositories;


use app\models\Order;

/**
 * Class OrderRepository contains methods for working with the 'orders' database table.
 * @package app\models\repositories
 */
class OrderRepository extends Repository
{
    /**
     * Returns 'orders' - the name of a orders table.
     * @return string
     */
    public function getTableName(): string
    {
        return 'orders';
    }

    /**
     * Returns the Order class name.
     * @return string
     */
    public function getEntityClass(): string
    {
        return Order::class;
    }
}