<?php

include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
include ROOT_DIR . "services/Autoloader.php";

use \app\services\Autoloader;

spl_autoload_register([new Autoloader(), 'loadClass']);


$product8 = \app\models\Product::getOne(8);
$product9 = \app\models\Product::getOne(9);
//$product = new \app\models\Product();
//var_dump($product);

//$product->properties['name'] = 'name4';
//$product->properties['price'] = 40;
//$product->properties['description'] = 'desc4';

$product8->delete();
$product9->delete();