<?php

namespace app\controllers;

use app\models\Product;

/**
 * Class ProductController manages all product actions.
 * @package app\controllers
 */
class ProductController extends Controller
{
    /**
     * Renders a catalog page.
     */
    protected function actionIndex()
    {
        $products = Product::getAll();
        echo $this->render('catalog', ['products' => $products]);
    }

    /**
     * Renders a card page.
     */
    protected function actionCard()
    {
        $id = $_GET['id'];
        $product = Product::getOne($id);
        echo $this->render('card', ['product' => $product], false);
    }
}