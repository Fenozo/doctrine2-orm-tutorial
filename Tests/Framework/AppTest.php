<?php
namespace Tests\Framework;

//use App\Application;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Psr7\ServerRequest;
use Framework\App;
use App\Blog\BlogModule;
use Zend\Stdlib\Request;
use Tests\Framework\Module\ErrorModule;
use Tests\Framework\Module\StringModule;
use Psr\Http\Message\ResponseInterface;


class AppTest extends  TestCase
{
    public function testRedirectTrailingSlash() {
        $app        = new App();
        $request    = new ServerRequest('GET','/demoSlash/');
        $response   = $app->run($request);

        $this->assertContains('/demoSlash',$response->getHeader('Location'));
        $this->assertEquals(301,$response->getStatusCode());
        //$this->assertContains('Location: /azeazeaze', headers_list());
    }

    public function testExceptionIfNoResponseSent() {
        $app    =   new App([
            ErrorModule::class
        ]);
        $request = new ServerRequest('GET','/demo');
        $app->run($request);
        $this->expectException(\Exception::class);
        //$this->assertContains('/demo',$response->getHeader('Location'));
    }
    public function testConvertStringToResponse() {
        $app    =   new App([
            StringModule::class
        ]);
        $request = new ServerRequest('GET','/demo');
        $response = $app->run($request);
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals('DEMO', (string)$response->getBody());
        //$this->assertContains('/demo',$response->getHeader('Location'));
    }

    public function testBlog() {
        $app        = new App([
            BlogModule::class
        ]);
        $request    = new ServerRequest('GET', '/blog');
        $response   = $app->run($request);


        $this->assertContains('<h1>Bienvenue sur le blog</h1>',(string)$response->getBody());
        $this->assertEquals(200, $response->getStatusCode());

        $requestSignle    = new ServerRequest('GET', '/blog/article-de-test');
        $responseSignle   = $app->run($requestSignle);
        $this->assertContains('<h1>Bienvenue sur l\'article </h1>',(string)$responseSignle->getBody());
    }

    public function testEuror404() {
        $app        = new App();
        $request    = new ServerRequest('GET', '/dfgdfg');
        $response   = $app->run($request);
        
        $this->assertContains('<h1>Error 404</h1>',(string)$response->getBody());
        $this->assertEquals(404, $response->getStatusCode());
    }
}
