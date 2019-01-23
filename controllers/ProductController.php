<?php

namespace app\controllers;

use app\base\App;
use app\models\repositories\ProductRepository;

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
     * @throws \app\services\RequestException
     */
    protected function actionCard()
    {
        $id = App::call()->request->getParams()['id'];
        $product = (new ProductRepository())->getOne($id);
        echo $this->render('card', ['product' => $product]);
    }


}