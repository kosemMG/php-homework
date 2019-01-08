<?php

namespace app\controllers;

use app\models\Product;

/**
 * Class ProductController
 * @package app\controllers
 */
class ProductController extends Controller
{
    protected function actionIndex()
    {
        echo 'catalog';
    }

    protected function actionCard()
    {
        $id = $_GET['id'];
        $product = Product::getOne($id);
        echo $this->render('card', ['product' => $product]);
    }
}