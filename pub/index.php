<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('BP', dirname(__DIR__));
define('APPNAME', 'Rent a Car!');
define('APPTITLE', 'Rent');
define('APPVERSION', '1.0.0');
define('URLROOT', 'http://phpacademy.inchoo.io/~polaznik17/');

spl_autoload_register(function ($class) {
    $class = lcfirst($class);
    $filename = BP . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (file_exists($filename)) {
        require $filename;
    }
});

session_start();

$router = new \App\Core\Router();
$app = new \App\Core\Application($router);

$resp = $app->start();

if ($resp) {
    echo $resp;
}

