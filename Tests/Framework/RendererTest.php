<?php
namespace Tests\Framework;

use PHPUnit\Framework\TestCase;
use Framework\Renderer;


class RendererTest extends TestCase
{
    private $renderer;

    public function setUp()
    {
        
        $this->renderer = new Renderer();
    }

    public function testRenderTheRightPath() {

        $this->renderer->addPath('blog',__DIR__.'/views');
        $content = $this->renderer->render('@blog/demo');
        $this->assertEquals('Salut les gens',$content);
    }
    
    public function testRenderTheDefaultPath() {
        $this->renderer->addPath(__DIR__.'/views');
        $content = $this->renderer->render('demo');
        $this->assertEquals('Salut les gens',$content);
    } 

    public function testRenderWithParams() {
        $this->renderer->addPath(__DIR__.'/views');
        $content = $this->renderer->render('demo',[
            'nom' => 'Marc'
        ]);
        $this->assertEquals('Salut les gens',$content);
    }

    public function testGlobalParameters() {
        $this->renderer->addGlobal('nom','marque');
        $content = $this->renderer->render('demoparams');
        $this->assertEquals('SALUT MARC', $content);


    }


}
