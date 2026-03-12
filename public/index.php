<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Security\CsrfToken;
use App\Controllers\VisitanteController;

CsrfToken::start();
$controller = new VisitanteController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($_POST);

} else {
    $controller->index();
}
