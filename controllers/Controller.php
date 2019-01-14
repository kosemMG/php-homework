<?php

namespace app\controllers;

/**
 * Class Controller - parent for all controllers
 * @package app\controllers
 */
abstract class Controller
{
    private $file_extension = '.php';

    private $action;
    private $default_action = 'index';

    private $layout = 'main';
    private $use_layout = true;

    /**
     * Runs passed action.
     * @param null $action
     */
    public function run($action = null)
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
     * @param $template
     * @param array $params
     * @return false|string
     */
    protected function render($template, $params = [])
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
     * @param $template
     * @param array $params
     * @return false|string
     */
    private function renderTemplate($template, $params = [])
    {
        ob_start();
        extract($params);
        $controller_name = @$_GET['c'] ?: DEFAULT_CONTROLLER;
        $subfolder = ucfirst($controller_name);
        $template_path = TEMPLATES_DIR . $subfolder . '/' . $template . $this->file_extension;
        include $template_path;
        return ob_get_clean();
    }
}