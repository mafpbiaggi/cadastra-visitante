<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Config\Bootstrap;

Bootstrap::startSession();

$router = require_once __DIR__ . '/../src/Config/Routes.php';
$router->dispatch();
