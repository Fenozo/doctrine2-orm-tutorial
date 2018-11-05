<?php
namespace Framework;

class Renderer
{
    const DEFAULT_NAMESPACE = '__MAIM';
    private $dirname    = '';

    private $paths      = [];

    /**
     *  variable global accessible globalement par les views
     * @var
     */
    private $globals    = [];

    /**
     * Permet d'ajouter le chemain des views
     * @param $namespace
     * @param $path
     */
    public function addPath(string $namespace, ?string $path = null):void
    {
        if (is_null($path)) {
            $this->paths[self::DEFAULT_NAMESPACE] = $namespace;
        } else {
            $this->paths[$namespace] = $path;
        }
    }

    /**
     *
     * @param $url
     */
    public function asset($url = null)
    {
        $protocol           = empty($_SERVER['HTTPS']) ? 'http' : 'https';
        $domain             = $_SERVER['SERVER_NAME'];
        $port               = $_SERVER['SERVER_PORT'];
        $disp_port          = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";

        $root                = "${protocol}://${domain}${disp_port}";

        if (!is_null($url)) {
            $base_url = str_replace('\\', DIRECTORY_SEPARATOR, $url);
            //return $root.DIRECTORY_SEPARATOR.$base_url;
            return $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$base_url;
        }
        return $root;
    }
    private function getDirpath()
    {
        //$_SERVER['HTTP_HOST'];

        $_SERVER['DOCUMENT_ROOT'] =  str_replace('\\', DIRECTORY_SEPARATOR, realpath($_SERVER['DOCUMENT_ROOT']));
        $exp = explode(DIRECTORY_SEPARATOR, $_SERVER['DOCUMENT_ROOT']);
        $dir = end($exp);

        return $dir;
    }

    /**
     * Permet d'ajouter des variable globale à tous les views.
     * @param string $key
     * @param mixed $value
     */
    public function addGlobal(string $key, $value):void
    {
        $this->globals[$key] = $value;
    }

    public function render(string $view, array $params = []): string
    {
        
        if ($this->hasNamespace($view)) {
            $path = $this->replaceNamespace($view) .'.php';
        } else {
            $path   = $this->paths[self::DEFAULT_NAMESPACE] .DIRECTORY_SEPARATOR . $view .'.php';
        }
        
        ob_start();
        $renderer = $this;
        extract($this->globals);
        extract($params);
        require($path);
        return  ob_get_clean();
    }

    private function hasNamespace(string $view) : bool
    {
        return (substr($view, 0, 1) == '@');
        //return $view[0] === '@';
    }

    private function getNamespace(string $view) :string
    {
        return substr($view, 1, strpos($view, '/')-1);
    }

    private function replaceNamespace(string $view) : string
    {
        $namespace = $this->getNamespace($view);
        return str_replace('@' . $namespace, $this->paths[$namespace], $view);
    }
}
