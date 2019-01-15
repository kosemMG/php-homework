<?php

namespace app\interfaces;

/**
 * Interface IRenderer
 * @package app\interfaces
 */
interface IRenderer
{
    /**
     * Renders a template, filling it with passed parameters.
     * @param $template
     * @param array $params
     * @return mixed
     */
    public function render($template, $params = []);
}