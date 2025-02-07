<?php
namespace src\app\Resource\Database;

use mysqli;
use Exception;
use src\app\Helpers\Logger;

class Database {
    use Logger;
    private mysqli $connection;

    public function __construct() {
        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $username = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];

        $this->connection = new mysqli($host, $username, $password, $dbname);

        if ($this->connection->connect_error) {
            $this->log($this->connection->connect_error);
            throw new Exception('Database connection failed: ' . $this->connection->connect_error);
        }
    }

    public function getConnection(): mysqli {
        return $this->connection;
    }
}