<?php

namespace App\Models;

use App\Config\Database;
use PDOException;

class VisitanteModel {

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addVisitante(array $data)
    {
        try{

            $stmt = $this->conn->prepare("INSERT INTO visitantes (dataVisita, nome, idade, email, telefone, frequentaIgreja,
                                    pedidoOracao, origem, outroComplemento, user_id, church_id, created, modified) VALUES (:dataVisita, :nome, :idade, :email,
                                    :telefone, :frequentaIgreja, :pedidoOracao, :origem, :outroComplemento, 66, 22, NOW(), NOW())");
            
            $stmt->bindValue(':dataVisita', $data['dataVisita']);
            $stmt->bindValue(':nome', $data['nome']);
            $stmt->bindValue(':idade', $data['idade']);
            $stmt->bindValue(':email', $data['email']);
            $stmt->bindValue(':telefone', $data['telefone']);
            $stmt->bindValue(':frequentaIgreja', $data['frequentaIgreja']);
            $stmt->bindValue(':pedidoOracao', $data['pedidoOracao']);
            $stmt->bindValue(':origem', $data['origem']);
            $stmt->bindValue(':outroComplemento', $data['outroComplemento']);
            $stmt->execute();

            return true;
     
        } catch (PDOException $e) {
            error_log($e->getMessage());

            return false;
        }
    }
}
