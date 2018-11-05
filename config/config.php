<?php

use Framework\Renderer\TwigRenderer;
use Framework\Renderer\TwigRendererFactory;
use Framework\Router;


return [
    'views.path' => dirname(__DIR__). DIRECTORY_SEPARATOR .'views',
    Router::class => \DI\create(),
    \Framework\Renderer\RendererInterface::class => \DI\Factory(TwigRendererFactory::class)
];