<?php
namespace Framework\Renderer;

class TwigRenderer implements RendererInterface
{
    
    private $twig ;
    private $loader ;

    /**
     *  variable global accessible globalement par les views
     * @var
     */
    private $globals    = [];


    public function __construct($defaultPath = null)
    {
        $this->loader = new \Twig_Loader_Filesystem($defaultPath);
        $this->twig   = new \Twig_Environment($this->loader, []);
    }


    /**
     * Permet d'ajouter le chemain des views
     * @param $namespace
     * @param $path
     */
    public function addPath(string $namespace, ?string $path = null):void
    {
        $this->loader->addPath($path, $namespace);
    }


    /**
     * Permet d'ajouter des variable globale à tous les views.
     * @param string $key
     * @param mixed $value
     */
    public function addGlobal(string $key, $value):void
    {
        $this->twig->addGlobal($key, $value);
    }

    public function render(string $view, array $params = []): string
    {
        
        return $this->twig->render($view . '.twig', $params);
    }
}
