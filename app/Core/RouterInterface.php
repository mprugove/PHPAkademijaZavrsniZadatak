<?php


namespace App\Core;


interface RouterInterface
{
    public function exact(string $pathInfo);
}