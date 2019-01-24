<?php

namespace app\models\repositories;



use app\models\entities\Order;

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


    /**
     * Writes an order into a database.
     * @param int $user_id
     */
    public function order(int $user_id)
    {
        $table_name = (new CartRepository())->getTableName();
        $sql = "SELECT * FROM {$table_name} WHERE user_id = :user_id";
        $cart_products = $this->db->queryAllObjects($sql, $this->getEntityClass(), [":user_id" => $user_id]);

        foreach ($cart_products as $cart_product) {
            $order = new Order();
            $order->user_id = $user_id;
            $order->product_id = $cart_product->product_id;
            $order->amount = $cart_product->amount;
            $this->commitChange($order);
        }
    }
}