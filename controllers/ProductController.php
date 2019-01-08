<?php

namespace app\controllers;

use app\models\Product;

/**
 * Class ProductController
 * @package app\controllers
 */
class ProductController
{
    private $action;
    private $default_action = 'index';

    private function actionIndex()
    {
        echo 'catalog';
    }

    private function actionCard()
    {
        $id = $_GET['id'];
        $product = Product::getOne($id);
        var_dump($product);
    }

    /**
     * Runs passed action.
     * @param null $action
     */
    public function run($action = null)
    {
        $this->action = $action ?: $this->default_action;
        $method = 'action' . ucfirst($this->action);

        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            echo '404';
        }
    }
}