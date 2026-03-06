<?php

namespace App\Controllers;

use App\Validator\BaseValidator;
use App\Models\VisitanteModel;

class VisitanteController {

    public function index(): void
    {
        require_once __DIR__ . '/../../resources/views/visitante/index.php';
    }

    public function store(array $data)
    {
        header('Content-Type: application/json');

        echo json_encode(['status' => 'true', 'msg' => implode("\n", $data)]);

        $validator = new BaseValidator();
        $result = $validator->validateAllFields($data);

        $errors=$result['errors'];

        if ($errors) {
            echo json_encode(['status' => 'false', 'msg' => implode("\n", $errors)]);
            exit;
        }

        echo "{$data}";
    }
}
