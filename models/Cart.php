<?php

namespace app\models;

use app\services\Db;

/**
 * Class Cart
 * @package app\models
 */
class Cart extends Record
{
    public $properties = [
        'id' => '',
        'product_id' => '',
        'amount' => ''
    ];

    public $old_properties = [
        'id' => '',
        'product_id' => '',
        'amount' => ''
    ];

    /**
     * Cart constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->old_properties = $this->properties;
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if (isset($this->properties[$name])) {
            $this->properties[$name] = $value;
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (isset($this->properties[$name])) {
            return $this->properties[$name];
        }
    }

    /**
     * Returns 'cart' the name of carts table.
     * @return string
     */
    public static function getTableName(): string
    {
        return 'cart';
    }

    /**
     * Returns an array of cart products objects.
     * @return array
     */
    public static function prepareCart()
    {
        $sql = "SELECT products.image_path, products.name, cart.amount, (products.price * cart.amount) AS price FROM  
                products, cart WHERE cart.product_id = products.id";

        return Db::getInstance()->queryAllObjects($sql, \stdClass::class);
    }

    /**
     * Adds a new product to the cart.
     */
    public static function addToCart()
    {
        $id = $_GET['id'];
        $product = Product::getOne($id);
        $cart_products = Cart::getAll();

        foreach ($cart_products as $cart_product) {
            if ($cart_product->product_id === $product->id) {
                $cart_product->amount++;
                $cart_product->commitChange();
                return;
            }
        }

        $cart_product = new Cart();
        $cart_product->product_id = $product->id;
        $cart_product->amount = 1;
        $cart_product->commitChange();
    }
}