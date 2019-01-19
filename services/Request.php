<?php

namespace app\services;

/**
 * Class Request contains methods for reading a URL.
 * @package app\services
 */
class Request
{
    private $controller_name;
    private $action_name;
    private $params;

    private $request_string;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->request_string = $_SERVER['REQUEST_URI'];
        $this->parseRequest();
    }

    /**
     * Parse a URL by regular expression.
     */
    private function parseRequest()
    {
        $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";

        if (preg_match_all($pattern, $this->request_string, $matches)) {
            $this->controller_name = $matches['controller'][0];
            $this->action_name = $matches['action'][0];
            $this->params = $_REQUEST;
        }
    }

    /**
     * Returns a controller name.
     * @return string|null
     */
    public function getControllerName()
    {
        return $this->controller_name;
    }

    /**
     * Returns an action name.
     * @return string|null
     */
    public function getActionName()
    {
        return $this->action_name;
    }

    /**
     * Returns an array of parameters.
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

}