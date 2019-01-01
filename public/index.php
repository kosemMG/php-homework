<?php

include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
include ROOT_DIR . "services/Autoloader.php";

use \app\services\Autoloader;
use \app\models;

spl_autoload_register([new Autoloader(), 'load_class']);

$product = new models\Product();
$user = new models\User();
$order = new models\Order();
$feedback = new models\Feedback();
var_dump($product);
var_dump($user);
var_dump($order);
var_dump($feedback);