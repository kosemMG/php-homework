<?php

namespace app\services;


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
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controller_name;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->action_name;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

}