<?php

namespace app\services;

class Autoloader
{
    protected $file_extension = '.php';

    public function loadClass($className)
    {
        $file_name = str_replace(['app\\', '\\'],  [ROOT_DIR, DIRECTORY_SEPARATOR], $className);
        $file_name .= $this->file_extension;

        if (file_exists($file_name)) {
            include $file_name;
        }
    }
}