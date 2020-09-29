<?php


namespace App\Core;


class Router implements RouterInterface
{
    public function exact( $pathInfo)
    {
        $pathInfo = trim($pathInfo, '/');
        $parts = $pathInfo ?
            explode('/', $pathInfo)
            : [];

        if (count($parts) > 3) {
            throw new \Exception('Not valid URL');
        }

        $controller = ucfirst(
                strtolower($parts[0] ?? 'home')
            ) . 'Controller';
        $method = strtolower($parts[1] ?? 'index') . 'Action';

        $className = "\\App\\Controller\\{$controller}";

        if (!method_exists($className, $method)) {
            throw new \Exception('Method does not exist');
        }

        $object = new $className();
        str_replace('~polaznik17/', '', $pathInfo);
        return $object->$method() ?? '';
    }
}