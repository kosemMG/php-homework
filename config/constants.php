<?php

// Directory constants
define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . "/../");
define('TEMPLATES_DIR', ROOT_DIR . 'templates/');
define('LAYOUTS_DIR', '../layouts/');
define('VENDOR_DIR', ROOT_DIR . 'vendor/');
define('TWIG_DIR', TEMPLATES_DIR . 'twig');

// Configuration constants
define('DEFAULT_CONTROLLER', 'product');
define('CONTROLLERS_NAMESPACE', '\\app\\controllers\\');

// Exceptions constants
define('INVALID_CONTROLLER', 1);
define('INVALID_ACTION', 2);