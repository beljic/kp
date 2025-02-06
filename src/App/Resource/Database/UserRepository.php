<?php

namespace src\Resource\Database;

use src\App\Database\Database;
use src\App\Helpers\Logger;
use PDOException;
use Exception;

readonly class UserRepository {
    use Logger;

    public function __construct(private Database $db) {}

    public function emailExists(string $email): bool {
        try {
            $query = "SELECT COUNT(*) FROM user WHERE email = :email";
            return $this->db->fetchColumn($query, [':email' => $email]) > 0;
        } catch (\PDOException | \Exception $e) {
            $this->logError("Database error checking email existence: " . $e->getMessage());
            throw new \Exception("Database error checking email existence.");
        }
    }

    public function createUser(string $email, string $password): int {
        try {
            $query = "INSERT INTO user (email, password, created_at) VALUES (:email, :password, NOW())";
            $this->db->execute($query, [':email' => $email, ':password' => password_hash($password, PASSWORD_DEFAULT)]);
            return $this->db->lastInsertId();
        } catch (\PDOException | \Exception $e) {
            $this->logError("Error creating user: " . $e->getMessage());
            throw new \Exception("Error creating user.");
        }
    }

    public function updateUser(int $userId, array $fields): void {
        try {
            $setParts = [];
            foreach ($fields as $key => $value) {
                $setParts[] = "$key = :$key";
            }
            $setClause = implode(", ", $setParts);

            $query = "UPDATE user SET $setClause WHERE id = :userId";
            $fields['userId'] = $userId;

            $this->db->execute($query, $fields);
        } catch (\PDOException | \Exception $e) {
            $this->logError("Error updating user: " . $e->getMessage());
            throw new \Exception("Error updating user.");
        }
    }

    public function logUserAction(int $userId, string $action): void {
        try {
            $query = "INSERT INTO user_log (user_id, action, log_time) VALUES (:userId, :action, NOW())";
            $this->db->execute($query, [':userId' => $userId, ':action' => $action]);
        } catch (\PDOException | \Exception $e) {
            $this->logError("Error logging user action: " . $e->getMessage());
            throw new \Exception("Error logging user action.");
        }
    }
}