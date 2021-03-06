<?php

namespace Tests\Framework;

use GuzzleHttp\Psr7\Request;
use Framework\Router;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Framework\ActionTestClass;
use Framework\App;


class RouterTest extends TestCase
{
    private $router;
    
    public function setup() {
        $this->router = new Router();
        
    }

    public function testGetMethod () {
        $app = new App();
        $request = new ServerRequest('GET','/blog');
        $app->run($request);
        $this->router->get('/blog', function () { return 'Hello'; }, 'blog');
        $route = $this->router->match($request);
        $this->assertEquals('blog', $route->getName());
        $this->assertContains('Hello', call_user_func_array($route->getCallback(),[$request]));


    }
    
    public function testGetMethodIfURLDoesNotExist () {
        $app = new App();
        $request = new ServerRequest('GET','/blog');
        $app->run($request);
        $this->router->get('/bloggaze', function (){ return "hello"; }, 'blog');
        $route = $this->router->match($request);
        $this->assertEquals(null, $route );

    }
    public function testGetMethodWithParameters () {
        $request = new ServerRequest('GET','/blog/mon-slug-8');
        $this->router->get('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', function (){ return "hello"; }, 'post.show');
        $route = $this->router->match($request);
        $this->assertEquals('post.show', $route->getName());
        $this->assertEquals('hello', \call_user_func_array($route->getCallback(),[$request]) );
        $this->assertEquals(['slug'=>'mon-slug','id' =>'8'], $route->getParams() );
        $route = $this->router->match(new ServerRequest('GET', '/blog/mon_slug-8'));
        $this->assertEquals(null, $route);

    }

    public function testGenerateUri() {
        $this->router->get('/blog', function (){ return 'azezeze';}, 'posts');
        $this->router->get('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', function (){ return 'hello';} ,'post.show');
        $uri = $this->router->generateUri('post.show',['slug'=>'mon-article','id'=>18]);
        $this->assertEquals('/blog/mon-article-18',$uri);
    }

}