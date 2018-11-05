<?php
namespace Framework\Renderer;

interface RendererInterface
{
    /**
     * Permet de rejouter un chemin pour charger les vues
     *
     * @param string $namespace
     * @param null|string $path
     */
    public function addPath(string $namespace, ?string $path = null):void;

    /**
     * Permet de rendre une vue
     * Le chemin peut être précisé avec des namespace rajouté via addPath()
     * $this->render('@blog/view');
     * $this->render('view');
     *
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render(string $view, array $params = []): string;

    /**
     * permet de rajouter des variables gloables à toutes les vues
     *
     * @param string $key
     * @param mixed $value
     *
     */
    public function addGlobal(string $key, $value): void;
}
