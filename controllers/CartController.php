<?php

namespace app\controllers;

use app\models\Cart;
use app\models\repositories\CartRepository;

class CartController extends Controller
{
    /**
     * Renders a cart.
     */
    protected function actionIndex()
    {
        $cart = (new CartRepository())->getCart();
        echo $this->render('cart', ['cart' => $cart]);
    }

    /**
     * Adds a product to the cart.
     */
    protected function actionAdd()
    {
        (new CartRepository())->addToCart();
    }

    /**
     * Removes a product from the cart.
     */
    protected function actionRemove()
    {
        (new CartRepository())->remove();
    }

    /**
     * Reduces the amount of items of a product in the cart.
     */
    protected function actionReduce()
    {
        (new CartRepository())->removeOne();
    }

    /**
     * Clears the cart.
     */
    protected function actionClear()
    {
        (new CartRepository())->clearCart();
    }
}