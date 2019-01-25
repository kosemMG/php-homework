<?php

return [
    'root_dir' => __DIR__ . '/../',
    'templates_dir' => __DIR__ . '/../templates/',
    'layouts_dir' => '../layouts/',
    'vendors_dir' => __DIR__ . '/../vendor/',
    'default_controller' => 'product',
    'controllers_namespace' => '\\app\\controllers\\',
    'salt' => 'sdf3434sd8fs42dfs',
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
        ],
        'session' => [
            'class' => \app\services\Session::class
        ],
        'cookie' => [
            'class' => \app\services\Cookie::class
        ],
//        'component' => [
//            'class' => \app\services\Component::class
//        ]
    ]
];