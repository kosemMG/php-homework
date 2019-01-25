<?php

namespace app\models\repositories;


use app\base\App;
use app\models\entities\Entity;
use app\models\entities\User;

/**
 * Class UserRepository contains methods for working with the 'users' database table.
 * @package app\models\repositories
 */
class UserRepository extends Repository
{
    private $allow = false;


    /**
     * Returns 'users' - the name of a users table.
     * @return string
     */
    public function getTableName(): string
    {
        return 'users';
    }


    /**
     * Returns the User class name.
     * @return string
     */
    public function getEntityClass(): string
    {
        return User::class;
    }


    /**
     * Gets a user by login and password.
     * @param string $login
     * @param string $pass
     * @return object|bool
     */
    public function getUser(string $login, string $pass)
    {
        $table_name = $this->getTableName();
        $sql = "SELECT * FROM `{$table_name}` WHERE `login` = :login AND `password` = :pass";

        return $this->db->queryObject($sql, $this->getEntityClass(), [':login' => $login, ':pass' => $pass]);
    }


    /**
     * Returns a user's name.
     * @param Entity $user
     * @return string
     */
    public function getUserName(Entity $user): string
    {
        return $user->name;
    }


    /**
     * Returns a user's email.
     * @param Entity $user
     * @return string
     */
    public function getUserEmail(Entity $user): string
    {
        return $user->email;
    }


    /**
     * Checks if the authorized user is admin.
     * @return bool
     */
    public function isAdmin(): bool
    {
        $cookie_login = App::call()->cookie->get('login');
        $session_login = App::call()->session->get('login');

        return $cookie_login === 'admin' || $session_login === 'admin';
    }


    /**
     * Checks if the user is authorized.
     * @return bool
     */
    public function isAuthorized(): bool
    {
        $salt = App::call()->config['salt'];
        $cookie_password = md5(App::call()->cookie->get('password') . $salt);
        $session_password = md5(App::call()->session->get('password') . $salt);

        return isset($cookie_password) || isset($session_password);
    }


    /**
     * User authorization.
     * @param string $login
     * @param string $password
     */
    public function auth(string $login, string  $password)
    {
        $users = $this->getAll();

        foreach ($users as $user) {
            if ($login === $user->login && $password === $user->password) {
                $salt = App::call()->config['salt'];
                $session = App::call()->session;

                $session->set('user_id', $user->id);
                $session->set('login', $user->login);
                $session->set('password', md5($user->id . $salt));

                $save_password = isset(App::call()->request->getParams()['save']);
                if ($save_password) {
                    setcookie('login', $user->login, time() + 15 * 60);
                    setcookie('password', md5($user->id . $salt), time() + 15 * 60);
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

        if ($cookie->is_set('login')) {
            $cookie->erase('login');
            $cookie->erase('password');
        }

        $session = App::call()->session;

        if ($session->is_set('login')) {
            $session->erase('login');
            $session->erase('password');
        }
    }
}
