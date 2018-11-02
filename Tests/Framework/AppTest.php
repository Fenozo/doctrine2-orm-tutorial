<?php
namespace Tests\Framework;

//use App\Application;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Psr7\ServerRequest;

class AppTest extends  TestCase
{
    public function testRedirectTrailingSlash() {
        $app        = new \Framework\App();
        $request    = new ServerRequest('GET','/demoSlash/');
        $response   = $app->run($request);

        $this->assertContains('/demoSlash',$response->getHeader('Location'));
        $this->assertEquals(301,$response->getStatusCode());
        //$this->assertContains('Location: /azeazeaze', headers_list());
    }

    public function testBlog() {
        $app        = new \Framework\App();
        $request    = new ServerRequest('GET', '/blog');
        $response   = $app->run($request);
        
        $this->assertContains('<h1>Bienvenue sur le blog</h1>',(string)$response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEuror404() {
        $app        = new \Framework\App();
        $request    = new ServerRequest('GET', '/dfgdfg');
        $response   = $app->run($request);
        
        $this->assertContains('<h1>Error 404</h1>',(string)$response->getBody());
        $this->assertEquals(404, $response->getStatusCode());
    }
}
