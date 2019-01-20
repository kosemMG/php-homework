<?php

namespace app\controllers;

use app\models\repositories\ProductRepository;
use app\services\Request;

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
        $products = (new ProductRepository())->getAll();
        echo $this->render('catalog', ['products' => $products]);
    }

    /**
     * Renders a card page.
     */
    protected function actionCard()
    {
        $id = (new Request())->getParams()['id'];
        $product = (new ProductRepository())->getOne($id);
        echo $this->render('card', ['product' => $product]);
    }
}