<?php

namespace app\base;


use app\services\Component;

class Storage
{
    private $items = [];

    /**
     * @param $key
     * @param $object
     */
    public function set($key, $object)
    {
        $this->items[$key] = $object;
    }

    /**
     * @param $key
     * @return mixed
     * @throws \Exception
     */
    public function get($key)
    {
        if (!isset($this->items[$key])) {
            $this->items[$key] = (new Component())->create($key);
        }

        return $this->items[$key];
    }
}