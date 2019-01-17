<?php

namespace app\controllers;

use app\models\Cart;

class CartController extends Controller
{
    /**
     * Renders a cart.
     */
    protected function actionIndex()
    {
        $cart = Cart::getCart();
        echo $this->render('cart', ['cart' => $cart]);
    }

    /**
     * Adds a product to the cart.
     */
    protected function actionAdd()
    {
        Cart::addToCart();
    }


    protected function actionRemove()
    {

    }
}