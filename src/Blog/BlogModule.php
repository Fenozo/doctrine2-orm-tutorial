<?php

namespace App\Blog;

use Framework\Router;
use Psr\Http\Message\ServerRequestInterface as Request;


use Framework\Module;
use Zend\Stdlib\ResponseInterface as Response;
use Framework\Renderer\RendererInterface;
use App\Blog\Actions\BlogAction;

class BlogModule extends Module
{
    const DEFINITIONS = __DIR__ .'/config.php';

    public function __construct(string $prefix, Router $router, RendererInterface $renderer)
    {
        
        $renderer->addPath('blog', __DIR__.'/views');
        $router->get($prefix, BlogAction::class, 'blog.index');
        $router->get($prefix.'/{slug:[a-z\-0-9]+}',BlogAction::class, 'blog.show');
    }

}
