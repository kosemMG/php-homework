<?php

namespace app\base;


use app\interfaces\IRenderer;
use app\services\Auth;
use app\services\Cookie;
use app\services\Db;
use app\services\Session;
use app\traits\TSingleton;
use app\services\Request;
use app\services\RequestException;

/**
 * Class App runs and manages the main application.
 * @package app\base
 * @property Db $db
 * @property Request $request
 * @property IRenderer $template_renderer
 * @property Session $session
 * @property Cookie $cookie
 * @property Auth $auth
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

        try {
            $this->runController();
        } catch (RequestException $exception) {
            header("Location: /error");
        }
    }

    /**
     * Runs the necessary controller.
     * @throws RequestException
     */
    private function runController()
    {
        $controller_name = App::call()->request->getControllerName() ?: $this->config['default_controller'];
        $action = App::call()->request->getActionName();

        $controller_class = $this->config['controllers_namespace'] . ucfirst($controller_name) . 'Controller';

        if (class_exists($controller_class)) {
            $template_renderer = App::call()->template_renderer;
            $controller = new $controller_class($template_renderer);
            try {
                $controller->run($action);
            } catch (RequestException $exception) {
                header("Location: /error");
            }
        } else {
            throw new RequestException('The URL is invalid.');
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
}