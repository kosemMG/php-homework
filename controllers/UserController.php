<?php

namespace app\controllers;


use app\base\App;
use app\models\repositories\UserRepository;

class UserController extends Controller
{
    /**
     * Renders an authorization page.
     */
    public function actionIndex()
    {
        echo $this->render('../login');
    }

    /**
     * Authorization.
     */
    public function actionLogin()
    {
        $auth = App::call()->auth;
        $request = App::call()->request;

        if ($request->isPost()) {
            $login = $request->getParams()[$auth->getLoginLabel()];
            $password = $request->getParams()[$auth->getPasswordLabel()];

            $auth->login($login, $password);
        }

        header("Location: {$request->getReferrer()}");
    }

    /**
     * Log out.
     */
    public function actionLogout()
    {
        App::call()->auth->logout();

        $request = App::call()->request;
        header("Location: {$request->getReferrer()}");
    }
}