<?php

namespace app\base;


use app\interfaces\IRenderer;
use app\services\Db;
use app\traits\TSingleton;
use app\services\renderers\TemplateRenderer;
use app\services\Request;
use app\services\RequestException;

/**
 * Class App
 * @package app\base
 * @property Db $db
 * @property Request $request
 * @property IRenderer $template_renderer
 */
class App
{
    use TSingleton;

    public $config;

    /**
     * @var Storage
     */
    private $components;

    /**
     * @return App
     */
    public static function call()
    {
        return static::getInstance();
    }

    /**
     * Runs the application.
     * @param array $config
     */
    public function run(array $config)
    {
        $this->config = $config;
        $this->components = new Storage();
        $this->runController();
    }

    /**
     * Runs the necessary controller.
     */
    private function runController()
    {
        try {
            $request = new Request();
        } catch (RequestException $exception) {
            header("Location: /error");
        }

        $controller_name = $request->getControllerName() ?: $this->config['default_controller'];
        $action = $request->getActionName();

        $controller_class = $this->config['controllers_namespace'] . ucfirst($controller_name) . 'Controller';

        if (class_exists($controller_class)) {
            $controller = new $controller_class(new TemplateRenderer());
            try {
                $controller->run($action);
            } catch (RequestException $exception) {
                header("Location: /error");
            }
        }
    }

    /**
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public function __get($name)
    {
        return $this->components->get($name);
    }

    /**
     * @param $name
     * @return object
     * @throws \ReflectionException
     */
    public function createComponent($name)
    {
        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
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