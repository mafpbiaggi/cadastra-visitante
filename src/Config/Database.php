<?php

namespace App\Config;

use PDO;
use PDOException;

class Database {

    private $host;
    private $database;
    private $user;
    private $pass;
    private $port;

    private $connection;

    public function __construct()
    {
        $this->host = getenv('DB_HOST');
        $this->database = getenv('DB_DATABASE');
        $this->user = getenv('DB_USER');
        $this->pass = getenv('DB_PASS');
        $this->port = getenv('DB_PORT');
    }

    public function getInstance()
    {
        if (!$this->connection) {
            try {
                $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->database};charset=utf8mb4";

                $this->connection = new PDO($dsn, $this->user, $this->pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
                ]);

            } catch (PDOException $e) {
                error_log($e->getMessage());
                return ['status' => 'false', 'msg' => 'Não foi possível iniciar a conexão.'];
            }
        }

        return $this->connection;
    }
}
