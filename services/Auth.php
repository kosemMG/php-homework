<?php

namespace app\services;

use app\base\App;
use app\models\repositories\UserRepository;

/**
 * Class Auth manages all the authorization methods.
 * @package app\services
 */
class Auth
{
    private $login_label;
    private $password_label;
    private $admin_login;

    /**
     * Auth constructor.
     */
    public function __construct()
    {
        $this->login_label = 'login';
        $this->password_label = 'password';
        $this->admin_login = 'admin';
    }


    /**
     * Checks if the authorized user is admin.
     * @return bool
     */
    public function isAdmin(): bool
    {
        $cookie_login = App::call()->cookie->get($this->login_label);
        $session_login = App::call()->session->get($this->login_label);

        return $cookie_login === $this->admin_login || $session_login === $this->admin_login;
    }


    /**
     * Checks if the user is authorized.
     * @return bool
     */
    public function isAuthorized(): bool
    {
        $salt = App::call()->config['salt'];
        $cookie_password = md5(App::call()->cookie->get($this->password_label) . $salt);
        $session_password = md5(App::call()->session->get($this->password_label) . $salt);

        return isset($cookie_password) || isset($session_password);
    }


    /**
     * User authorization.
     * @param string $login
     * @param string $password
     */
    public function login(string $login, string  $password)
    {
        $users = (new UserRepository())->getAll();

        foreach ($users as $user) {
            if ($login === $user->login && $password === $user->password) {
                $salt = App::call()->config['salt'];
                $session = App::call()->session;

                $session->set('user_id', $user->id);
                $session->set($this->login_label, $user->login);
                $session->set($this->password_label, md5($user->id . $salt));

                $save_password = isset(App::call()->request->getParams()['save']);
                if ($save_password) {
                    setcookie($this->login_label, $user->login, time() + 15 * 60);
                    setcookie($this->password_label, md5($user->id . $salt), time() + 15 * 60);
                }
            }
        }
    }


    /**
     * User logout.
     */
    public function logout()
    {
        $cookie = App::call()->cookie;

        if ($cookie->is_set($this->login_label)) {
            $cookie->erase($this->login_label);
            $cookie->erase($this->password_label);
        }

        $session = App::call()->session;

        if ($session->is_set($this->login_label)) {
            $session->erase($this->login_label);
            $session->erase($this->password_label);
        }
    }

}