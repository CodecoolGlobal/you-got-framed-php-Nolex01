<?php

require_once '../vendor/autoload.php';

use eftec\bladeone\BladeOne;

$viewsPath = dirname(__DIR__) . '/app/Views';
$cachePath = dirname(__DIR__) . '/cache';
$blade = new BladeOne($viewsPath, $cachePath);

$configFile = dirname(__DIR__) . '/app/config/config.json';
$configJson = file_get_contents($configFile);
$config = json_decode($configJson, true);

$routes = [
    '/' => 'HomeController@index',
];

$uri = $_SERVER['REQUEST_URI'];
if (array_key_exists($uri, $routes)) {
    list($controllerName, $action) = explode('@', $routes[$uri]);
    $controllerName = 'App\\Controllers\\' . $controllerName;
    $controller = new $controllerName();
    $controller->$action();
} else {
    http_response_code(404);
    echo '404 Not Found';
}
