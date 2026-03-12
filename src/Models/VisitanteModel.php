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
        try {

            $stmt = $this->conn->prepare("INSERT INTO visitantes (dataVisita, nome, idade, email, telefone, frequentaIgreja,
                                    pedidoOracao, origem, outroComp, redesSociaisComp, user_id, church_id, created, modified) VALUES (:dataVisita, :nome, :idade, :email,
                                    :telefone, :frequentaIgreja, :pedidoOracao, :origem, :outroComp, :redesSociaisComp, 66, 22, NOW(), NOW())");
            
            $stmt->bindValue(':dataVisita', $data['dataVisita']);
            $stmt->bindValue(':nome', $data['nome']);
            $stmt->bindValue(':idade', $data['idade']);
            $stmt->bindValue(':email', $data['email']);
            $stmt->bindValue(':telefone', $data['telefone']);
            $stmt->bindValue(':frequentaIgreja', $data['frequentaIgreja']);
            $stmt->bindValue(':pedidoOracao', $data['pedidoOracao']);
            $stmt->bindValue(':origem', $data['origem']);
            $stmt->bindValue(':outroComp', $data['outroComp']);
            $stmt->bindValue(':redesSociaisComp', $data['redesSociaisComp']);
            $stmt->execute();

            return true;
     
        } catch (PDOException $e) {

            error_log($e->getMessage());

            return false;
        }
    }
}
