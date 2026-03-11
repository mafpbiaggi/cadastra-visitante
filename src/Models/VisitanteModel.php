<?php

namespace App\Models;

use App\Config\Database;
use PDOException;

class VisitanteModel {

    public function addVisitante(array $data)
    {
        try{
            $db = new Database();
            $conn = $db->getInstance();

            $stmt = $conn->prepare("INSERT INTO visitantes (dataVisita, nome, idade, email, telefone, frequentaIgreja,
                                    pedidoOracao, origem, user_id, church_id, created, modified) VALUES (:dataVisita, :nome, :idade, :email,
                                    :telefone, :frequentaIgreja, :pedidoOracao, :origem, 22, 66, NOW(), NOW();");
            
            $stmt->bindValue(':dataVisita', $data['dataVisita']);
            $stmt->bindValue(':nome', $data['nome']);
            $stmt->bindValue(':idade', $data['idade']);
            $stmt->bindValue(':email', $data['email']);
            $stmt->bindValue(':telefone', $data['telefone']);
            $stmt->bindValue(':frequentaIgreja', $data['frequentaIgreja']);
            $stmt->bindValue(':pedidoOracao', $data['pedidoOracao']);
            $stmt->bindValue(':origem', $data['origem']);
            $stmt->execute();

            return ['status' => 'true', 'msg' => 'Envio de dados efetuado com sucesso.'];
     
        } catch (PDOException $e) {
            error_log($e->getMessage());

            return ['status' => 'false', 'msg' => 'Envio de dados não efetuado.\nContate o administrador.'];
        }
    }
}
