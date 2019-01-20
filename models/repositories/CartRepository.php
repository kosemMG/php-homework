<?php

namespace app\models\repositories;


use app\models\entities\Cart;
use app\services\Request;

/**
 * Class CartRepository contains methods working with the database cart table.
 * @package app\models\repositories
 */
class CartRepository extends Repository
{
    /**
     * Returns 'cart' - the name of a cart table.
     * @return string
     */
    public function getTableName(): string
    {
        return 'cart';
    }

    /**
     * Returns the Cart class name.
     * @return string
     */
    public function getEntityClass(): string
    {
        return Cart::class;
    }

    /**
     * Returns an array of cart products objects.
     * @return array
     */
    public function getCart()
    {
        $sql = "SELECT cart.product_id, products.image_path, products.name, cart.amount, (products.price * cart.amount) AS price FROM  
                products, cart WHERE cart.product_id = products.id";

        return $this->db->queryAllObjects($sql, \stdClass::class);
    }

    /**
     * Adds a new product to the cart (in DB).
     */
    public function addToCart()
    {
        $id = (new Request())->getParams()['id'];
        $cart_products = $this->getAll();

        $product = new Cart();
        $product->product_id = $id;
        $product->amount = 1;

        foreach ($cart_products as $cart_product) {
            if ($cart_product->product_id === $id) {
                $cart_product = $this->getOne($id, 'product_id');
                $product->id = $cart_product->id;
                $product->amount = $cart_product->amount + 1;
                break;
            }
        }

        $this->commitChange($product);
        header('Location: /');
    }

    /**
     * Removes an item from a cart by reducing amount column.
     */
    public function removeOne()
    {
        $id = (new Request())->getParams()['id'];

        $cart_product = $this->getOne($id, 'product_id');

        if ($cart_product->amount > 1) {
            $product = new Cart();
            $product->product_id = $id;
            $product->id = $cart_product->id;
            $product->amount = $cart_product->amount - 1;
            $this->commitChange($product);
            header('Location: /cart');
        } else {
            $this->remove();
        }
    }

    /**
     * Removes a whole record from a 'cart' table.
     */
    public function remove()
    {
        $id = (new Request())->getParams()['id'];

        $product = new Cart();
        $product->product_id = $id;
        $cart_product = $this->getOne($id, 'product_id');
        $product->id = $cart_product->id;

        $this->delete($product);
        header('Location: /cart');
    }

    /**
     * Removes all the records from a 'cart' table.
     */
    public function clearCart()
    {
        $this->clear();
        header('Location: /cart');
    }
}