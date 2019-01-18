<?php

include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
include VENDOR_DIR . 'autoload.php';

use app\services\renderers\TemplateRenderer;
use app\services\Request;

$request = new Request();

$controller_name = $request->getControllerName() ?: DEFAULT_CONTROLLER;
$action = $request->getActionName();

$controller_class = CONTROLLERS_NAMESPACE . ucfirst($controller_name) . 'Controller';

if (class_exists($controller_class)) {
    $controller = new $controller_class(new TemplateRenderer());
    $controller->run($action);
}