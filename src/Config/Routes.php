<?php

use App\Config\Router;
use App\Controllers\VisitanteController;

$router = new Router();

$router->get('/',  VisitanteController::class, 'index');
$router->post('/', VisitanteController::class, 'store');

return $router;
