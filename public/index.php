<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\VisitanteController;

$controller = new VisitanteController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($_POST);
} else {
    $controller->index();
}
