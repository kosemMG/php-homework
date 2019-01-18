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


    protected function actionRemove()
    {

    }
}