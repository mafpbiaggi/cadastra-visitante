<?php

namespace App\Controllers;

class BaseController {
    
    public function json (bool $status, string $msg, int $code = 200): void
    {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf8');
        echo json_encode(['status' => $status, 'msg' => $msg, 'code' => $code]);
    }
}
