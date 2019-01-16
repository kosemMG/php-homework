<?php

namespace app\services\renderers;

use app\interfaces\IRenderer;

/**
 * Class TwigRenderer
 * @package app\services
 */
class TwigRenderer implements IRenderer
{
    public function render($template, $params = [])
    {
        return '';
    }
}