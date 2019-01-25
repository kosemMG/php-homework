<?php

namespace app\services;


use app\base\App;

class Component
{
    /**
     * @param $name
     * @return object
     * @throws \ReflectionException
     */
    public function create($name)
    {
        if (isset(App::call()->config['components'][$name])) {
            $params = App::call()->config['components'][$name];
            $class = $params['class'];

            if (class_exists($class)) {
                $reflection = new \ReflectionClass($class);
                unset($params['class']);

                return $reflection->newInstanceArgs($params);
            }
            throw new \Exception("The component class {$class} is not declared.");
        }
        throw new \Exception("The component {$name} is not declared.");
    }
}