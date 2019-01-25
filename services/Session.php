<?php

namespace app\services;

/**
 * Class Session manages sessions.
 * @package app\services
 */
class Session
{
    /**
     * Session constructor.
     */
    public function __construct()
    {
        session_start();
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