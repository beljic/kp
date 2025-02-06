<?php
namespace src\App\Database;

use mysqli;
use src\App\Helpers\Logger;

class Database {
    use Logger;
    private \mysqli $connection;

    public function __construct(
        private string $host = '127.0.0.1',
        private string $user = 'my_user',
        private string $password = 'my_password',
        private string $db = 'my_db'
    ) {
        $this->connection = new \mysqli($this->host, $this->user, $this->password, $this->db);
        if ($this->connection->connect_error) {
            $this->log($this->connection->connect_error);
            throw new \Exception('Database connection failed');
        }
    }

    public function query(string $sql): mixed {
        $result = $this->connection->query($sql);
        if ($this->connection->error) {
            $this->log($this->connection->error);
            throw new \Exception('Database query failed');
        }
        return $result;
    }
}