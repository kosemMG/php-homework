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