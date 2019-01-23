<?php

return [
    'root_dir' => __DIR__ . '/../',
    'templates_dir' => __DIR__ . '/../templates/',
    'layouts_dir' => '../layouts/',
    'vendors_dir' => __DIR__ . '/../vendor/',
    'default_controller' => 'product',
    'controllers_namespace' => '\\app\\controllers\\',
    'components' => [
        'db' => [
            'class' => \app\services\Db::class,
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'login' => 'root',
            'password' => 'password',
            'database' => 'brand_shop',
            'charset' => 'utf8'
        ],
        'request' => [
            'class' => \app\services\Request::class
        ],
        'template_renderer' => [
            'class' => \app\services\renderers\TemplateRenderer::class
        ]
    ]
];