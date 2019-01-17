<?php

include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
//include ROOT_DIR . "services/Autoloader.php";
include VENDOR_DIR . 'autoload.php';

//use \app\services\Autoloader;
use app\services\renderers\TemplateRenderer;
use \app\services\renderers\TwigRenderer;

//spl_autoload_register([new Autoloader(), 'loadClass']);

$controller_name = @$_GET['c'] ?: DEFAULT_CONTROLLER;
$action = @$_GET['a'];

$controller_class = CONTROLLERS_NAMESPACE . ucfirst($controller_name) . 'Controller';

$loader = new Twig_Loader_Filesystem(TWIG_DIR);
$twig = new Twig_Environment($loader);

if (class_exists($controller_class)) {
    $controller = new $controller_class(new TwigRenderer($twig));
    $controller = new $controller_class(new TemplateRenderer());
    $controller->run($action);
}