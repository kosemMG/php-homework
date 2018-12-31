<?php

include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
include ROOT_DIR . "services/Autoloader.php";

use \app\services\Autoloader;

spl_autoload_register([new Autoloader(), 'load_class']);

$product = new \app\models\Product();
var_dump($product);