<?php

namespace App\Blog;

use Framework\Router;
use Psr\Http\Message\ServerRequestInterface as Request;
// use GuzzleHttp\Psr7\ServerRequest as Request;

use Zend\Stdlib\ResponseInterface as Response;
use Framework\Renderer;

class BlogModule
{
    private $renderer;


    public function __construct(Router $router, Renderer $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->addPath('blog', __DIR__.'/views');

        $router->get('/blog', [$this, 'index'], 'blog.index');
        $router->get('/blog/{slug:[a-z\-0-9]+}', [$this, 'show'], 'blog.show');
    }

    public function index(Request $request) : string
    {
        return $this->renderer->render('@blog/index');
    }
    public function show(Request $request) : string
    {
        return $this->renderer->render('@blog/show', [
            'slug' => $request->getAttribute('slug')
        ]);
        //return '<h1>Bienvenue sur l\'article '.$request->getAttribute('slug').'</h1>';
    }
}
