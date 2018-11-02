<?php
namespace Framework\Router;

/**
 * Class Route
 * Represent a matched route
 */
class Route {
    private $name;
    private $callable;
    private $parameters;


    public function __construct(string $name, callable $callable, array $parameters)
    {
        $this->name     = $name;
        $this->callable = $callable;
        $this->parameters     = $parameters;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }
    /**
     * 
     * @return callable
     */
    public function getCallback(): callable {
        return $this->callable;
    }
    /**
     * Retourne les liste de paramètre
     * @return string[];
     */
    public function getParams(): array {
        return $this->parameters;
    }


}