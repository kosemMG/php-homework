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
        echo $this->render('login');
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

        header("Location: /");
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

    /**
     * Sign up.
     */
    public function actionSignup()
    {
        echo $this->render('signup');

        $request = App::call()->request;

        if ($request->isPost()) {
            $login = $request->getParams()['login'];
            $password = $request->getParams()['password'];
            $name = $request->getParams()['name'];
            $email = $request->getParams()['email'];

            $users = new UserRepository();

            if (!$users->search(['login' => $login, 'email' => $email])) {
                $users->signUp($login, $password, $name, $email);
                App::call()->auth->login($login, $password);
                header('Location: /');
            } else {
                header('Location: /user/occupied');
            }
        }
    }

    public function actionOccupied()
    {
        echo $this->render('occupied');
    }
}