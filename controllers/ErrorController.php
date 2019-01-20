<?php

namespace app\controllers;

/**
 * Class ErrorController manages the errors.
 * @package app\controllers
 */
class ErrorController extends Controller
{
    /**
     * Error 404 - the page was not found.
     */
    protected function actionIndex()
    {
        echo $this->render('../404');
    }
}