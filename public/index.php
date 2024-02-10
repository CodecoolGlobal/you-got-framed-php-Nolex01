<?php

require_once '../vendor/autoload.php';

$configFile = __DIR__ . '/config/config.json';
$configJson = file_get_contents($configFile);
$config = json_decode($configJson, true);