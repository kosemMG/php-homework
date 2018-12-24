<?php

require $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
require ROOT_DIR . 'services/autoloader.php';

spl_autoload_register([new app\services\Autoloader(), 'loadClass']);

$product = new \app\models\Product();

var_dump($product);