<?php

namespace app\services;

use app\interfaces\IRenderer;

class TemplateRenderer implements IRenderer
{
    private $file_extension = '.php';

    public function render($template, $params = [])
    {
        ob_start();
        extract($params);
        $template_path = TEMPLATES_DIR . $template . $this->file_extension;
        include $template_path;
        return ob_get_clean();
    }
}