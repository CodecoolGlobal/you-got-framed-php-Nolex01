<?php

require_once '../vendor/autoload.php';

use eftec\bladeone\BladeOne;

$viewsPath = dirname(__DIR__) . '/app/Views';
$cachePath = dirname(__DIR__) . '/cache';
$blade = new BladeOne($viewsPath, $cachePath);

$configFile = dirname(__DIR__) . '/app/config/config.json';
$configJson = file_get_contents($configFile);
$config = json_decode($configJson, true);

$allowedMethods = $config['allowedMethods'] ?? [];
$allowedIPs = $config['allowedIPs'] ?? [];
$allowedBrowsers = $config['allowedBrowsers'] ?? [];

$uri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if (array_key_exists($uri, $allowedMethods) && !in_array($requestMethod, $allowedMethods[$uri])) {
    http_response_code(405);
    echo '405 Method Not Allowed';
    exit;
}

$clientIP = $_SERVER['REMOTE_ADDR'];
if (!in_array($clientIP, $allowedIPs)) {
    http_response_code(403);
    echo '403 Forbidden';
    exit;
}

$userAgent = $_SERVER['HTTP_USER_AGENT'];
$browser = get_browser(null, true)['browser'];
if (!in_array($browser, $allowedBrowsers)) {
    http_response_code(403);
    echo '403 Forbidden';
    exit;
}

$routes = [
    '/' => 'HomeController@index',
];

if (array_key_exists($uri, $routes)) {
    list($controllerName, $action) = explode('@', $routes[$uri]);
    $controllerName = 'App\\Controllers\\' . $controllerName;
    $controller = new $controllerName();
    $controller->$action();
} else {
    http_response_code(404);
    echo '404 Not Found';
}
