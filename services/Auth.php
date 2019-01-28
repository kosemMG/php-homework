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
    private $user_id_label;
    private $login_label;
    private $password_label;
    private $admin_login;

    /**
     * Auth constructor.
     */
    public function __construct()
    {
        $this->user_id_label = 'user_id';
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
        $session_id = App::call()->session->getUserId();
        $cookie_id = App::call()->cookie->getUserId();

        return !is_null($session_id) || !is_null($cookie_id);
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
                App::call()->session->setUserId($user->id);

                $save_password = isset(App::call()->request->getParams()['save']);
                if ($save_password) {
                    App::call()->cookie->setUserId($user->id, time() + 15 * 60);
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

        if ($cookie->is_set($this->user_id_label)) {
            $cookie->erase($this->user_id_label);
        }

        $session = App::call()->session;

        if ($session->is_set($this->user_id_label)) {
            $session->erase($this->user_id_label);
        }
    }

    /**
     * @return string
     */
    public function getLoginLabel(): string
    {
        return $this->login_label;
    }

    /**
     * @return string
     */
    public function getPasswordLabel(): string
    {
        return $this->password_label;
    }

    /**
     * @return string
     */
    public function getAdminLogin(): string
    {
        return $this->admin_login;
    }
}