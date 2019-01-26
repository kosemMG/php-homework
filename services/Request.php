<?php

namespace app\services;

use app\base\App;

class RequestException extends \Exception{}

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

    private $request_method;
    private $referrer;

    /**
     * Request constructor.
     * @throws RequestException
     */
    public function __construct()
    {
        $this->request_string = $_SERVER['REQUEST_URI'];
        $this->request_method = $_SERVER['REQUEST_METHOD'];
        $this->referrer = $_SERVER['HTTP_REFERER'];

        $this->parseRequest();
    }


    /**
     * Parse a URL by regular expression.
     * @throws RequestException
     */
    private function parseRequest()
    {
        $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";

        if (preg_match_all($pattern, $this->request_string, $matches)) {
            $this->controller_name = $matches['controller'][0];
            $this->action_name = $matches['action'][0];
            $this->params = $_REQUEST;

            if (!class_exists(App::call()->config['controllers_namespace'] . ucfirst($this->controller_name) . 'Controller')) {
                throw new RequestException('The URL is invalid.', 1);
            }
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


    /**
     * Defines the request method.
     * @return mixed
     */
    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }


    /**
     * Defines whether the request has been done by GET method.
     * @return bool
     */
    public function isGet(): bool
    {
        return $this->request_method === "GET";
    }


    /**
     * Defines whether the request has been done by POST method.
     * @return bool
     */
    public function isPost(): bool
    {
        return $this->request_method === "POST";
    }


    /**
     * Defines whether the request was AJAX.
     * @return bool
     */
    public function isAjax(): bool
    {
        return $_SERVER['HTTP_X_REQUEST_WITH'] === 'XMLHttpRequest';
    }


    /**
     * Returns a referrer.
     * @return mixed
     */
    public function getReferrer()
    {
        return $this->referrer;
    }
}