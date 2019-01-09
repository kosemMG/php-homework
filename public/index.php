<?php

include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
include ROOT_DIR . "services/Autoloader.php";

use \app\services\Autoloader;

spl_autoload_register([new Autoloader(), 'loadClass']);


$product = \app\models\Product::getOne(3);
//$product = new \app\models\Product();
var_dump($product);

//$product->properties['name'] = 'name1';
//$product->properties['price'] = 10;
//$product->properties['description'] = 'desc1';

//$product->delete();