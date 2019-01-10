<?php

include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
include ROOT_DIR . "services/Autoloader.php";

use \app\services\Autoloader;
use app\models\Product;

spl_autoload_register([new Autoloader(), 'loadClass']);

// Update test
$product = Product::getOne(3);

$product->name = 'new_name';
$product->price = 400;
$product->description = 'new description';
//$product->properties['name'] = 'name3';

// Insert test
//$product = new Product();
//var_dump($product);

//$product->properties['name'] = 'name4';
//$product->properties['price'] = 40;
//$product->properties['description'] = 'desc4';

$product->commitChange();