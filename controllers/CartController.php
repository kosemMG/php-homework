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
        $user_id = App::call()->session->getUserId();
        if ($user_id) {
            $cart = (new CartRepository())->getCart($user_id);
            echo $this->render('cart', ['cart' => $cart]);
        } else {
            echo $this->render('unauthorized');
        }
    }


    /**
     * Adds a product to the cart.
     */
    protected function actionAdd()
    {
        $request = App::call()->request;

        if (App::call()->auth->isAuthorized() && $request->isPost()) {
            $user_id = (int)App::call()->session->getUserId();
            $id = (int)$request->getParams()['id'];
            $amount = (int)$request->getParams()['amount'];

            if ($amount > 0) {
                (new CartRepository())->addToCart($user_id, $id, $amount);
                header('Location: /');
            } else {
                header("Location: {$request->getReferrer()}");
            }

        } else {
            echo $this->render('unauthorized');
        }

    }


    /**
     * Removes a product from the cart.
     */
    protected function actionRemove()
    {
        $user_id = (int)App::call()->session->getUserId();
        $id = (int)App::call()->request->getParams()['id'];

        (new CartRepository())->remove($user_id, $id);
        header('Location: /cart');
    }


    /**
     * Reduces the amount of items of a product in the cart.
     */
    protected function actionReduce()
    {
        $user_id = (int)App::call()->session->getUserId();
        $id = (int)App::call()->request->getParams()['id'];
        (new CartRepository())->removeOne($user_id, $id);
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