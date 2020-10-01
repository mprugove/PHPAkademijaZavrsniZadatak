<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\View;

abstract class AController
{
    protected $view;
    protected $auth;

    public function __construct()
    {
        $this->view = new View();
        $this->auth = Auth::getInstance();
    }

    protected function isPOST()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function isGET()
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }
}