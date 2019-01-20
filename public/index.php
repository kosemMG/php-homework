<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
require_once VENDOR_DIR . 'autoload.php';

use app\services\renderers\TemplateRenderer;
use app\services\Request;
use app\services\RequestException;

try {
    $request = new Request();
} catch (RequestException $exception) {
    header("Location: /error");
}

    $controller_name = $request->getControllerName() ?: DEFAULT_CONTROLLER;
    $action = $request->getActionName();

    $controller_class = CONTROLLERS_NAMESPACE . ucfirst($controller_name) . 'Controller';

    if (class_exists($controller_class)) {
        $controller = new $controller_class(new TemplateRenderer());
        try {
            $controller->run($action);
        } catch (RequestException $exception) {
            header("Location: /error");
        }

    }