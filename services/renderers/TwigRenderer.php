<?php

namespace app\services\renderers;

use app\interfaces\IRenderer;

/**
 * Class TwigRenderer renders a page via Twig template engine.
 * @package app\services
 */
class TwigRenderer implements IRenderer
{
    private $file_extension = '.twig';

    private $renderer;

    /**
     * TwigRenderer constructor.
     * @param $renderer
     */
    public function __construct($renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param string $template
     * @param string $class_name
     * @param array $params
     * @return mixed
     */
    public function render(string $template, string $class_name = null, array $params = [])
    {
        $template .= $this->file_extension;

        return $this->renderer->render($template, $params);
    }
}