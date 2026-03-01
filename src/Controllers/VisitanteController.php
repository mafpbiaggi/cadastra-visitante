<?php

namespace App\Controllers;

class VisitanteController
{
    public function index(): void
    {
        require __DIR__ . '/../../resources/views/visitante/index.php';
    }

    public function store(array $data): void
    {
        // Por enquanto só debug
        var_dump($data);
    }
}
