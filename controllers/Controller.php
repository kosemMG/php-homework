<?php

namespace app\controllers;

use app\interfaces\IRenderer;
use app\services\renderers\TemplateRenderer;

/**
 * Class Controller - parent for all controllers
 * @package app\controllers
 */
abstract class Controller
{
    private $action;
    private $default_action = 'index';

    private $layout = 'main';
    private $use_layout = true;

    private $renderer;

    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Runs passed action.
     * @param null|string $action
     */
    public function run(string $action = null)
    {
        $this->action = $action ?: $this->default_action;
        $method = 'action' . ucfirst($this->action);

        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            echo 'Error 404';
        }
    }

    /**
     * Renders a page, using particular templates.
     * @param string $template
     * @param array $params
     * @return false|string
     */
    protected function render(string $template, array $params = [])
    {
        if ($this->use_layout) {
            $content = $this->renderTemplate($template, $params);
            $result = $this->renderTemplate(LAYOUTS_DIR . $this->layout, ['content' => $content]);

            return $result;
        }

        return $this->renderTemplate($template, $params);
    }

    /**
     * Renders a template, filling it with passed parameters.
     * @param string $template
     * @param array $params
     * @return false|string
     */
    private function renderTemplate(string $template, array $params = [])
    {
        return $this->renderer->render($template, get_called_class(), $params);
    }
}