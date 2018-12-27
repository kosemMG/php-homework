<?php

require $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
require ROOT_DIR . 'services/Autoloader.php';

use app\services\Autoloader;
use app\models\Product;

spl_autoload_register([new Autoloader(), 'loadClass']);

$product = new Product();

var_dump($product);