<?php

include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
include ROOT_DIR . "services/Autoloader.php";

use \app\services\Autoloader;
use app\services\renderers\TemplateRenderer;

spl_autoload_register([new Autoloader(), 'loadClass']);

$controller_name = @$_GET['c'] ?: DEFAULT_CONTROLLER;
$action = @$_GET['a'];

$controller_class = CONTROLLERS_NAMESPACE . ucfirst($controller_name) . 'Controller';

if (class_exists($controller_class)) {
    $controller = new $controller_class(new TemplateRenderer());
    $controller->run($action);
}