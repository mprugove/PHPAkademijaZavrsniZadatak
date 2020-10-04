<?php

namespace App\Core;

class Application
{
    protected $router;

    public function __construct(RouterInterface $router) {
        $this->router = $router;
    }

    public function start()
    {
        return $this->router->exact($_SERVER['PATH_INFO'] ?? '/');
    }
}