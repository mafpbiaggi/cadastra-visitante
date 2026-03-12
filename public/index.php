<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Security\CsrfToken;

CsrfToken::start();

$router = require_once __DIR__ . '/../src/Config/Routes.php';
$router->dispatch();
