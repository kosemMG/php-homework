<?php

namespace app\controllers;

use app\models\Cart;

class CartController extends Controller
{
    protected function actionIndex()
    {
        $cart = Cart::prepareCart();
        echo $this->render('cart', ['cart' => $cart]);
    }

    protected function actionAdd()
    {

    }
}