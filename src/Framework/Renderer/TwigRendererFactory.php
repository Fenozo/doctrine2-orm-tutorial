<?php

namespace Framework\Renderer;

use Psr\Container\ContainerInterface;
use Framework\Router\RouterTwigExtension;


class TwigRendererFactory
{
    public function __invoke(ContainerInterface $container): TwigRenderer
    {
        $viewPath = $container->get('views.path');
        $loader = new \Twig_Loader_Filesystem($viewPath);
        $twig = new \Twig_Environment($loader);
        $twig->addExtension($container->get(RouterTwigExtension::class));
        return new TwigRenderer($loader, $twig);
        //return new TwigRenderer($container->get('views.path'));
    }
}
