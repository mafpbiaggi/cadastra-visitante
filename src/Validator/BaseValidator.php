<?php

namespace App\Validator;

class BaseValidator {

    private $errors = [];
    private $rules = [
        'dataVisita' => ['required' => true],
        'nome' => ['required' => true, 'max' => 50],
        'idade' => ['required' => true],
        'telefone' => ['required' => true],
        'email' => ['required' => true],
        'frequentaIgreja' => ['required' => false, 'max' => 70],
        'pedidoOracao' => ['required' => false, 'max' => 70],
        'origem' => ['required' => true],
        'outroComp' => ['required' => false, 'max' => 50],
        'redesSociaisComp' => ['required' => false, 'max' => 50],
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
            $errors[] = "E-mail inválido ou incompleto.";
        }

        return $errors;
    }

    public function validatePhone(string $field, array $errors)
    {
        $field = preg_replace('/\D/', '', $field);

        if (preg_match('/^(\d)\1+$/', $field)) {
            $errors[] = "Telefone inválido.";
        }

        if (strlen($field) < 10) {
            $errors[] = "Telefone incompleto.";
        }

        return $errors;
    }

    public function validateAllFields(array $data)
    {
        $rules = $this->rules;
        $errors = $this->errors;

        foreach ($rules as $field => $rule) {
            $data[$field] = $this->sanitizeField($data, $field);
            
            if ($rule['required'] && empty($data[$field])) {
                $errors[] = "O campo {$field} é obrigatório.";
                continue;
            }

            if (isset($rule['max']) && strlen($data[$field]) > $rule['max']) {
                $errors[] = "O campo {$field} excede o tamanho máximo ({$rule['max']} caracteres).";
                continue;
            }

            if ($field === 'email') {
                $errors = $this->validateEmail($data[$field], $errors);
                continue;
            }

            if ($field === 'telefone') {
                $errors = $this->validatePhone($data[$field], $errors);
            }
        }

        return ['errors' => $errors, 'sanitized' => $data];
    }

    public function checkFields(array $data)
    {
        $rules = $this->rules;

        foreach ($rules as $field => $rule) {
            if (!isset($data[$field])) {
                $data[$field] = '';
            }
        }

        return $data;
    }
}
