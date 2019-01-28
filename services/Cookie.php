<?php

namespace app\services;

/**
 * Class Cookie manages cookies.
 * @package app\services
 */
class Cookie
{
    /**
     * Gets a cookie element by key.
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $_COOKIE[$key];
    }

    /**
     * Returns a user's id from cookies.
     * @return mixed
     */
    public function getUserId()
    {
        return $_COOKIE['user_id'] ?? null;
    }

    /**
     * Sets a user's id into cookie.
     * @param int $id
     * @param int $expire
     */
    public function setUserId(int $id, int $expire)
    {
        setcookie('user_id', $id, $expire);
    }

    /**
     * Checks if a cookie element is set.
     * @param string $key
     * @return bool
     */
    public function is_set(string $key): bool
    {
        return isset($_COOKIE[$key]);
    }

    /**
     * Removes a cookie element by key.
     * @param string $key
     */
    public function erase(string $key)
    {
        setcookie($key);
    }
}