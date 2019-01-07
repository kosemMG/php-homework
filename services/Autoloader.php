<?php

namespace app\services;

class Autoloader
{

    public function loadClass($class_name)
    {
        $file_name = str_replace(["app\\", "\\"], [ROOT_DIR, DIRECTORY_SEPARATOR], $class_name);
        $file_name .= '.php';

        if (file_exists($file_name)) {
            include $file_name;
        } else {
            echo "Class file {$file_name} is not found";
        }
    }
}