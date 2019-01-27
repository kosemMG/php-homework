<?php

namespace app\controllers;

use app\models\repositories\CartRepository;
use app\base\App;

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
        $id = App::call()->request->getParams()['id'];
        (new CartRepository())->addToCart($id);
        header('Location: /');
    }


    /**
     * Removes a product from the cart.
     */
    protected function actionRemove()
    {
        $id = App::call()->request->getParams()['id'];
        (new CartRepository())->remove($id);
        header('Location: /cart');
    }


    /**
     * Reduces the amount of items of a product in the cart.
     */
    protected function actionReduce()
    {
        $id = App::call()->request->getParams()['id'];
        (new CartRepository())->removeOne($id);
        header('Location: /cart');
    }


    /**
     * Clears the cart.
     */
    protected function actionClear()
    {
        (new CartRepository())->clearCart();
        header('Location: /cart');
    }
}