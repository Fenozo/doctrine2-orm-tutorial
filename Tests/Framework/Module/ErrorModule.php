<?php
namespace Tests\Framework\Module;

class ErrorModule 
{

    public function __construct(\Framework\Router $router)
    {
        $router->get('/demo', function (){
            return new \stdClass();
        },'demo');
    }
    
}
