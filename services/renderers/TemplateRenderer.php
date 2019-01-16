<?php

namespace app\services\renderers;

use app\interfaces\IRenderer;

/**
 * Class TemplateRenderer
 * @package app\services
 */
class TemplateRenderer implements IRenderer
{
    private $file_extension = '.php';

    /**
     * Renders a template, filling it with passed parameters.
     * @param $template
     * @param array $params
     * @return false|mixed|string
     */
    public function render($template, $class_name, $params = [])
    {
        ob_start();
        extract($params);
        $template_path =
            TEMPLATES_DIR . $this->createSubdir($class_name) . DIRECTORY_SEPARATOR . $template . $this->file_extension;
        include $template_path;
        return ob_get_clean();
    }

    /**
     * Returns a template subdirectory.
     * @param $class_name
     * @return bool|string
     */
    private function createSubdir($class_name)
    {
        return substr(strrchr($class_name, '\\'), 1, -10);
    }
}