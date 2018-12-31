<?php

namespace app\services;

class Autoloader
{

    public function load_class($class_name)
    {
        $file_name = str_replace(["app\\", "\\"], [ROOT_DIR, DIRECTORY_SEPARATOR], $class_name);
        $file_name .= '.php';

        if (file_exists($file_name)) {
            include $file_name;
        }
    }
}