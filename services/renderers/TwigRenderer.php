<?php

namespace app\services\renderers;

use app\interfaces\IRenderer;
use Twig_Loader_Filesystem;
use Twig_Environment;

/**
 * Class TwigRenderer renders a page via Twig template engine.
 * @package app\services
 */
class TwigRenderer implements IRenderer
{
    private $file_extension = '.twig';

    /**
     * @param string $template
     * @param string $class_name
     * @param array $params
     * @return mixed|string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function render(string $template, string $class_name, array $params = [])
    {
        $loader = new Twig_Loader_Filesystem(TWIG_DIR);
        $twig = new Twig_Environment($loader);

        $template .= $this->file_extension;

        return $twig->render($template, $params);
    }
}