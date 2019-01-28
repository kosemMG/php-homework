<?php

namespace app\services;

use app\base\App;

/**
 * Class Session manages sessions.
 * @package app\services
 */
class Session
{
    private $user_id_label;

    /**
     * Session constructor.
     */
    public function __construct()
    {
        session_start();
        $this->user_id_label = 'user_id';

        $cookie = App::call()->cookie;
        if ($cookie->is_set($this->user_id_label)) {
            $this->set($this->user_id_label, $cookie->getUserId());
        }
    }


    /**
     * Gets a session element by key.
     * @param $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $_SESSION[$key];
    }


    /**
     * Sets a session element by key.
     * @param string $key
     * @param $value
     */
    public function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Returns a user's id from session.
     * @return mixed
     */
    public function getUserId()
    {
        return $_SESSION[$this->user_id_label] ?? null;
    }

    /**
     * Sets a user's id into session.
     * @param int $id
     */
    public function setUserId(int $id)
    {
        $this->set('user_id', $id);
    }


    /**
     * Removes a session element by key.
     * @param string $key
     */
    public function erase(string $key)
    {
        unset($_SESSION[$key]);
    }


    /**
     * Checks if a session element is set.
     * @param string $key
     * @return bool
     */
    public function is_set(string $key): bool
    {
        return isset($_SESSION[$key]);
    }
}