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
        $result = [];

        $validator = new BaseValidator();
        $result = $validator->validateAllFields($data);

        $errors = $result['errors'];
        $data = $result['sanitized'];

        if ($errors) {
            echo json_encode(['status' => false, 'msg' => implode("\n", $errors)]);
            exit;
        }

        $msg = "Dados enviados com sucesso.";
        echo json_encode(['status' => true, 'msg' => $msg]);
    }
}
