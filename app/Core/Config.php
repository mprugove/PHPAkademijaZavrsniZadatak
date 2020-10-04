<?php

namespace App\Core;
class Config
{
    public static function get(string $key)
    {
        $configPath = BP . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'config.php';
        $config = include $configPath;
        return $config[$key] ?? null;
    }
}