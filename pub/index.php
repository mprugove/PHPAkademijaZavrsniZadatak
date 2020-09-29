<?php
require_once '../app/config.php';


define('BP', dirname(__DIR__));
define('APPNAME', 'Rent a Car!');
define('APPTITLE', 'Rental');
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
