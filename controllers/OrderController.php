<?php

namespace app\controllers;


use app\models\repositories\CartRepository;
use app\models\repositories\OrderRepository;
use app\base\App;

class OrderController extends Controller
{
    /**
     * Makes an order of cart products for particular user.
     * @throws \app\services\RequestException
     */
    protected function actionIndex()
    {
        $user_id = App::call()->request->getParams()['id'];
        (new OrderRepository())->order($user_id);
        (new CartRepository())->clearCart();
    }
}