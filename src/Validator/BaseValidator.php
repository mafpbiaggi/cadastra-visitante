<?php

namespace App\Validator;

class BaseValidator {

    private $errors = [];
    private $rules = [
        'dataVisita' => ['required' => 'true'],
        'nome' => ['required' => 'true', 'max' => 30],
        'idade' => ['required' => 'true'],
        'telefone' => ['required' => 'false'],
        'email' => ['required' => 'true'],
        'frequentaIgreja' => ['required' => 'false', 'max' => 30],
        'pedidoOracao' => ['required' => 'false', 'max' => 30],
        'origem' => ['required' => 'true'],
    ];

    public function sanitizeField(array $data, string $field)
    {
        $sanitized = trim($data[$field]);

        if ($field === 'email') {
            $sanitized = mb_strtolower($sanitized);
     
        } else {
            $sanitized = mb_strtoupper($sanitized);
        }

        return $sanitized;
    }

    public function validateEmail(string $field, array $errors)
    {
        if (!filter_var($field, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "E-mail inválido.";
            return $errors;
        }
    }

    public function validateAllFields(array $data)
    {
        $rules = $this->rules;
        $errors = $this->errors;

        foreach ($rules as $field => $rule) {
            $sanitized = $this->sanitizeField($data, $field);

            if ($rule['required'] && empty($sanitized[$field])) {
                $errors[] = "O campo {$field} é obrigatório.";
            }

            if (isset($rule['max']) && strlen($sanitized[$field]) > $rule['max']) {
                $errors[] = "O campo {$field} excede o tamanho máximo ({$rule['max']} caracteres).";
                continue;
            }

            if ($field === 'email') {
                $this->validateEmail($sanitized[$field], $errors);
            }
        }

        return ['errors' => $errors, 'sanitized' => $sanitized];
    }

}
