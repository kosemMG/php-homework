<?php

namespace app\services\renderers;

use app\base\App;
use app\interfaces\IRenderer;

/**
 * Class TemplateRenderer
 * @package app\services\renderers
 */
class TemplateRenderer implements IRenderer
{
    private $file_extension = '.php';

    /**
     * Renders a template, filling it with passed parameters.
     * @param string $template
     * @param string|null $class_name
     * @param array $params
     * @return false|mixed|string
     */
    public function render(string $template, string $class_name = null, array $params = [])
    {
        ob_start();
        extract($params);
        $template_path = App::call()->config['templates_dir'] . $this->createSubdir($class_name)
            . DIRECTORY_SEPARATOR . $template . $this->file_extension;
        include $template_path;
        return ob_get_clean();
    }

    /**
     * Returns a template subdirectory.
     * @param string $class_name
     * @return bool|string
     */
    private function createSubdir(string $class_name)
    {
        return substr(strrchr($class_name, '\\'), 1, -10);
    }
}