<?php
namespace src\app\Resource\Database;

use Exception;
use src\app\Helpers\Logger;

readonly class UserRepository
{
    use Logger;

    public function __construct(private Database $db)
    {
    }

    /**
     * @throws Exception
     */
    public function emailExists(string $email): bool
    {
        try {
            $query = "SELECT COUNT(*) FROM user WHERE email = ?";
            $stmt = $this->db->getConnection()->prepare($query);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();
            return $count > 0;
        } catch (Exception $e) {
            $this->logError("Database error checking email existence: " . $e->getMessage());
            throw new Exception("Database error checking email existence.");
        }
    }

    /**
     * @throws Exception
     */
    public function createUser(string $email, string $password): int
    {
        try {
            $query = "INSERT INTO user (email, password, created_at) VALUES (?, ?, NOW())";
            $stmt = $this->db->getConnection()->prepare($query);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param('ss', $email, $hashedPassword);
            $stmt->execute();
            $userId = $stmt->insert_id;
            $stmt->close();
            return $userId;
        } catch (Exception $e) {
            $this->logError("Error creating user: " . $e->getMessage());
            throw new Exception("Error creating user.");
        }
    }

    /**
     * @throws Exception
     */
    public function updateUser(int $userId, array $fields): void
    {
        try {
            $setParts = [];
            $types = '';
            $values = [];
            foreach ($fields as $key => $value) {
                $setParts[] = "$key = ?";
                $types .= is_int($value) ? 'i' : 's';
                $values[] = $value;
            }
            $setClause = implode(", ", $setParts);
            $types .= 'i';
            $values[] = $userId;

            $query = "UPDATE user SET $setClause WHERE id = ?";
            $stmt = $this->db->getConnection()->prepare($query);
            $stmt->bind_param($types, ...$values);
            $stmt->execute();
            $stmt->close();
        } catch (Exception $e) {
            $this->logError("Error updating user: " . $e->getMessage());
            throw new Exception("Error updating user.");
        }
    }

    /**
     * @throws Exception
     */
    public function logUserAction(int $userId, string $action): void
    {
        try {
            $query = "INSERT INTO user_log (user_id, action, log_time) VALUES (?, ?, NOW())";
            $stmt = $this->db->getConnection()->prepare($query);
            $stmt->bind_param('is', $userId, $action);
            $stmt->execute();
            $stmt->close();
        } catch (Exception $e) {
            $this->logError("Error logging user action: " . $e->getMessage());
            throw new Exception("Error logging user action.");
        }
    }
}
