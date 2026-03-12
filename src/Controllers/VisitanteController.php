<?php

namespace App\Controllers;

use App\Validator\BaseValidator;
use App\Config\Database;
use App\Security\CsrfToken;
use App\Models\VisitanteModel;

class VisitanteController extends BaseController {

    public function index(): void
    {
        CsrfToken::generate();
        require_once __DIR__ . '/../../resources/views/visitante/index.php';
    }

    public function store(array $data)
    {
        header('Content-Type: application/json; charset=utf-8');
        $submittedToken = $data['csrf_token'] ?? '';

        if (!CsrfToken::validate($submittedToken)) {
            $this->json(false, 'Requisição inválida. Recarregue a página e tente novamente.', $submittedToken, 403);
            exit;
        }

        CsrfToken::invalidate();
        $newToken = CsrfToken::generate();

        unset($data['csrf_token']);

        $validator = new BaseValidator();
        $data = $validator->checkFields($data);
        $result = $validator->validateAllFields($data);

        $errors = $result['errors'];
        $data = $result['sanitized'];

        if ($errors) {
            $this->json(false, implode("\n", $errors), $newToken);
            exit;
        }
        
        $db = new Database();
        $conn = $db->getInstance();
        
        $mdl = new VisitanteModel($conn);
        $success = $mdl->addVisitante($data);

        if ($success) {
            $this->json(true, 'Dados enviados com sucesso.', $newToken);
    
        } else {
            $this->json(false, 'Não foi possível enviar os dados.', $newToken);
        }
    }
}
