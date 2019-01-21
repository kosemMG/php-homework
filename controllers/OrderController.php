<?php

namespace app\controllers;


use app\models\repositories\CartRepository;
use app\models\repositories\OrderRepository;

class OrderController extends Controller
{
    /**
     * Makes an order of cart products for particular user.
     * @throws \app\services\RequestException
     */
    protected function actionIndex()
    {
        (new OrderRepository())->order();
        (new CartRepository())->clearCart();
    }
}