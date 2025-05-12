<?php
require_once __DIR__ . '/../config/Database.php';

class UserDao
{
    private $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    // Get All Users
    public function getAllUsers()
    {
        try {
            $query = "SELECT * FROM users";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching users: " . $e->getMessage();
            return [];
        }
    }

    // Add a New User
    public function addUser($data)
    {
        try {
            $query = "INSERT INTO users (name, email, password, role) 
                      VALUES (:name, :email, :password, :role)";
            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':password', $data['password'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
            $stmt->bindParam(':role', $data['role'], PDO::PARAM_STR);

            $stmt->execute();
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            echo "Error adding user: " . $e->getMessage();
            return null;
        }
    }

    // Update User Role
    public function updateUserRole($userId, $role)
    {
        try {
            $query = "UPDATE users SET role = :role WHERE id = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':role', $role, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Error updating user role: " . $e->getMessage();
            return 0;
        }
    }

     // Delete User
     public function deleteUser($userId)
     {
         try {
             $query = "DELETE FROM users WHERE id = :id";
             $stmt = $this->connection->prepare($query);
 
             $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
             $stmt->execute();
             return $stmt->rowCount(); 
         } catch (PDOException $e) {
             echo "Error deleting user status: " . $e->getMessage();
             return 0;
         }
     }

     public function getUserByEmail($email) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($userId) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}
?>
