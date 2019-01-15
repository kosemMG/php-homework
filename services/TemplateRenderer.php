<?php

namespace app\services;

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
    public function render($template, $params = [])
    {
        ob_start();
        extract($params);
        $template_path = TEMPLATES_DIR . $template . $this->file_extension;
        include $template_path;
        return ob_get_clean();
    }
}