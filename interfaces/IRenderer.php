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
     * @param string $template
     * @param string|null $class_name
     * @param array $params
     * @return mixed
     */
    public function render(string $template, string $class_name = null, array $params = []);
}